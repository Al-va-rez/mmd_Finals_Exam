<?php
    require_once 'dbConfig.php';


    
    /* --- INPUT SECURITY --- */
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validatePassword($password) {
        if (strlen($password) > 8) { // longer than 8 char
            $hasLower = false;
            $hasUpper = false;
            $hasNumber = false;

            for ($i = 0; $i < strlen($password); $i++) {
                if (ctype_lower($password[$i])) { // has lower case
                    $hasLower = true; 
                }
                elseif (ctype_upper($password[$i])) { // has upper case
                    $hasUpper = true; 
                }
                elseif (ctype_digit($password[$i])) { // has numbers
                    $hasNumber = true;
                }
                
                if ($hasLower && $hasUpper && $hasNumber) {
                    return true; 
                }
            }
        } else {
            return false; 
        }
    }

    

    /* --- USER ACCOUNTS --- */
    // CHECK IF ALREADY REGISTERED
    function check_UserExists($pdo, $username) {
        $response = array();

        $sql = "SELECT * FROM user_credentials WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$username])) {

            $userInfo = $stmt->fetch();

            if ($stmt->rowCount() > 0) { // user already in database
                $response = array(
                    "result" => true,
                    "status" => "200",
                    "userInfo" => $userInfo
                );
            } else { // green light for adding user
                $response = array(
                    "result" => false,
                    "status" => "400",
                    "message" => "User not found in database"
                );
            }
        }

        return $response;
    }

    // REGISTER
    function register($pdo, $userRole, $username, $first_Name, $last_Name, $password) {

        $response = array();

        $check_User = check_UserExists($pdo, $username);
        
        if (!$check_User['result']) { // add user to database

            // *problem: users with same passwords

            $sql = "INSERT INTO user_credentials (role, username, first_Name, last_Name, password) VALUES (?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$userRole, $username, $first_Name, $last_Name, $password])) {
                $response = "Success";
            }

        } else { // user already registered
            $response = "User already registered";
        }

        return $response;
    }

    // get all users
    function getAllUsers($pdo) {
        $sql = "SELECT * FROM user_credentials WHERE role = 'User' ORDER BY user_id";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute();

        if ($query) {
            return $stmt->fetchAll();
        }
    }

    // suspend/unsuspend user
    function changeAccountStatus($pdo, $userId, $accountStatus) {
        $sql = "UPDATE user_credentials SET account_Status = ? WHERE user_id = ? AND role = 'User'";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$accountStatus, $userId]);

        if ($query) {
            return true;
        }
    }        

    // check if user suspended
    function check_UserSuspended($pdo, $userId) {
        $sql = "SELECT account_Status FROM user_credentials WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$userId]);

        if ($query) {
            $result = $stmt->fetch();
            return $result['account_Status'] == 'Suspended';
        }
    }

    // search user
    function search_Users($pdo, $searchQuery) {
        $sql = "SELECT * FROM user_credentials WHERE username LIKE ?";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute(["%" . $searchQuery . "%"]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }



    /* --- DOCUMENTS --- */
    // create
    function createDocument($pdo, $owner_id) {
        $sql = "INSERT INTO documents (owner_id, title, content) VALUES (?,'Untitled Document', '')";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$owner_id]);

        if ($query) {
            return true;
        }
    }

    function getNewDocument($pdo, $owner_id) {
        $sql = "SELECT * FROM documents WHERE owner_id = ? ORDER BY date_created DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$owner_id]);

        if ($query) {
            return $stmt->fetch();
        }
    }

    function getAccessedDocument($pdo, $docId) {
        $sql = "SELECT * FROM documents WHERE document_id = ?";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId]);

        if ($query) {
            return $stmt->fetch();
        }
    }

    function getAllDocuments($pdo) {
        $sql = "SELECT * FROM documents
                JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                ORDER BY documents.date_created DESC";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }

    // get all documents for user
    function getRecentDocuments($pdo, $user_id) {
        $sql = "SELECT documents.*, user_credentials.*, 'owner' AS access_type
                FROM documents
                JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                WHERE documents.owner_id = ? AND DATE(documents.date_created) = CURDATE()
                UNION
                    SELECT documents.*, user_credentials.*, 'shared' AS access_type
                    FROM documents
                    JOIN document_shares ON documents.document_id = document_shares.document_id
                    JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                    WHERE document_shares.collaborator_id = ? AND DATE(documents.date_created) = CURDATE()
                    ORDER BY date_created DESC";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$user_id, $user_id]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }

    function getOlderDocuments($pdo, $user_id) {
        $sql = "SELECT documents.*, user_credentials.*, 'owner' AS access_type
                FROM documents
                JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                WHERE documents.owner_id = ? AND DATE(documents.date_created) < CURDATE()
                UNION
                    SELECT documents.*, user_credentials.*, 'shared' AS access_type
                    FROM documents
                    JOIN document_shares ON documents.document_id = document_shares.document_id
                    JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                    WHERE document_shares.collaborator_id = ? AND DATE(documents.date_created) < CURDATE()
                    ORDER BY date_created DESC";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$user_id, $user_id]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }


    // record changes
    function recordChanges($pdo, $docId, $userId, $changes_made) {
        $sql = "INSERT INTO activity_logs (document_id, done_by, changes_made) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId, $userId, $changes_made]);

        if ($query) {
            return true;
        }
    }

    function getChanges($pdo, $docId) {
        $sql = "SELECT activity_logs.*, user_credentials.username
                FROM activity_logs
                JOIN user_credentials ON activity_logs.done_by = user_credentials.user_id
                WHERE activity_logs.document_id = ?
                ORDER BY activity_logs.date_updated DESC";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }

    // save document
    function saveDocument($pdo, $content, $docId, $userId) {
        $sql = "UPDATE documents SET content = ? WHERE document_id = ?";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$content, $docId]);

        if ($query) {
            recordChanges($pdo, $docId, $userId, $content);
            return true;
        }
    }
    
    // share document
    function shareDocument($pdo, $docId, $collaboratorId) {
        $sql = "INSERT INTO document_shares (document_id, collaborator_id) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId, $collaboratorId]);

        if ($query) {
            return true;
        }
    }

    function unshareDocument($pdo, $docId, $collaboratorId) {
        $sql = "DELETE FROM document_shares WHERE document_id = ? AND collaborator_id = ?";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId, $collaboratorId]);

        if ($query) {
            return true;
        }
    }

    function check_documentShared($pdo, $docId, $collaboratorId) {
        $sql = "SELECT * FROM document_shares
                JOIN user_credentials ON document_shares.collaborator_id = user_credentials.user_id
                WHERE document_shares.document_id = ? AND document_shares.collaborator_id = ?";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId, $collaboratorId]);

        if ($query) {
            return $stmt->fetch();
        }
    }

    function check_documentOwned($pdo, $docId, $user_id) {
        $sql = "SELECT 1 FROM documents
                JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                WHERE documents.document_id = ? AND documents.owner_id = ?";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId, $user_id]);

        if ($query) {
            return $stmt->fetch();
        }
    }

    // delete document
    function deleteDocument($pdo, $docId) {
        $sql = "DELETE FROM documents WHERE document_id = ?";
        $stmt = $pdo->prepare($sql);

        // also delete all activity logs and shares related to this document

        $query = $stmt->execute([$docId]);

        if ($query) {
            return true;
        }
    }


    /* --- MESSAGES --- */
    // send
    function sendMessage($pdo, $docId, $senderId, $message) {
        $sql = "INSERT INTO document_messages (document_id, sender_id, msg_content) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId, $senderId, $message]);

        if ($query) {
            return true;
        }
    }


    // get messages
    function getMessages($pdo, $docId) {
        $sql = "SELECT document_messages.*, user_credentials.username
                FROM document_messages
                JOIN user_credentials ON document_messages.sender_id = user_credentials.user_id
                WHERE document_messages.document_id = ?
                ORDER BY document_messages.date_sent";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$docId]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }

?>