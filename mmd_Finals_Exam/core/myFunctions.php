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


    // get all documents for user
    function getRecentDocuments($pdo, $owner_id) {
        $sql = "SELECT * FROM documents
                JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                WHERE documents.owner_id = ? AND DATE(documents.date_created) = CURDATE()
                ORDER BY documents.date_created DESC";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$owner_id]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }

    function getOlderDocuments($pdo, $owner_id) {
        $sql = "SELECT * FROM documents
                JOIN user_credentials ON documents.owner_id = user_credentials.user_id
                WHERE documents.owner_id = ? AND DATE(documents.date_created) < CURDATE()
                ORDER BY documents.date_created DESC";
        $stmt = $pdo->prepare($sql);

        $query = $stmt->execute([$owner_id]);

        if ($query) {
            return $stmt->fetchAll();
        }
    }
    
?>