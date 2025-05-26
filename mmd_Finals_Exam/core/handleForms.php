<?php
    require_once 'dbConfig.php';
    require_once 'myFunctions.php';


    
    /* --- USERS --- */
    // register
    if (isset($_POST['registerReq'])) {

        $userRole = sanitizeInput($_POST['userRole']);
        $username = sanitizeInput($_POST['username']);
        $firstName = sanitizeInput($_POST['firstName']);
        $lastName = sanitizeInput($_POST['lastName']);
        $tempPassword = sanitizeInput($_POST['password']);
        $confirmPassword = sanitizeInput($_POST['confirmPassword']);

        if ($tempPassword == $confirmPassword) {

            if (validatePassword($tempPassword)) { // check password strength

                $password = password_hash($tempPassword, PASSWORD_DEFAULT); // encrypt password

                $result = register($pdo, $userRole, $username, $firstName, $lastName, $password); // add user

                echo $result;

            } else {
                echo "Weak password";
            }
        } else {
            echo "Passwords not the same";
        }
        
    }

    // login
    if (isset($_POST['loginReq'])) {

        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        $check_User = check_UserExists($pdo, $username);
        
        if ($check_User['result']) { // user found in database
            
            $role_FromDB = $check_User['userInfo']['role'];
            $userId_FromDB = $check_User['userInfo']['user_id'];
            $username_FromDB = $check_User['userInfo']['username'];
            $password_FromDB = $check_User['userInfo']['password'];

            if (password_verify($password, $password_FromDB)) {

                $_SESSION['user_id'] = $userId_FromDB;
                $_SESSION['username'] = $username_FromDB;
                $_SESSION['role'] = $role_FromDB;

                $checkSuspension = check_UserSuspended($pdo, $_SESSION['user_id']);

                if (!$checkSuspension) {

                    if ($_SESSION['role'] == 'Admin') {
                        echo "Login as admin";
                    } else if ($_SESSION['role'] == 'User') {
                        echo "Login as user";
                    }
                    
                } else {
                    echo "User suspended";
                }

            } else {
                echo "Incorrect Password";
            }

        } else {
            echo "User not yet registered";
        }
    }

    // logout
    if (isset($_GET['btn_Logout'])) {
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: ../index.php');
    }


    // suspend
    if (isset($_POST['changeStatusReq'])) {
        $userId = sanitizeInput($_POST['userId']);
        $accountStatus = sanitizeInput($_POST['status']);

        $result = changeAccountStatus($pdo, $userId, $accountStatus);

        if ($result) {
            echo "Success";
        } else {
            echo "Error suspending user";
        }
    }

    if (isset($_POST['searchReq'])) {

        $searchQuery = sanitizeInput($_POST['username']);
        $docId = sanitizeInput($_POST['docId']);

        $result = search_Users($pdo, $searchQuery);

        if ($result) {
            foreach ($result as $user) {
                $check_documentShared = check_documentShared($pdo, $docId, $user['user_id']);
                $checked = $check_documentShared ? 'checked' : '';

                echo "<div class='collaborator flex flex-row items-center justify-between px-4 py-2' data-collaborator-id='{$user['user_id']}'>
                        <div>{$user['username']}</div>
                        <input type='checkbox' class='shareDocument' $checked>
                    </div>";
            }
        } else {
            echo "No users found";
        }
    }




    /* --- DOCUMENTS --- */
    // create document
    if (isset($_POST['createReq'])) {

        $result = createDocument($pdo, $_SESSION['user_id']);

        if ($result) {
            echo "Document created";
        } else {
            echo "Error creating document";
        }
    }


    if (isset($_POST['saveReq'])) {
        $content = $_POST['content'];
        $docId = sanitizeInput($_POST['docId']);
        $userId = $_SESSION['user_id'];
        
        $result = saveDocument($pdo, $content, $docId, $userId);

        if ($result) {

            $allChanges = getChanges($pdo, $docId);

            foreach ($allChanges as $change) {

                echo "<div class='space-y-4 p-4'>
                        <div><span class='font-semibold'>Done By:</span> {$change['username']}</div>
                        <div><span class='font-semibold'>Changes made:</span>
                            <div class='w-[90%] mx-auto'>
                                {$change['changes_made']}
                            </div>
                        </div>
                        <div><span class='font-semibold'>Time:</span> {$change['date_updated']}</div>
                    </div>";
            }
        } else {
            echo "Error saving document";
        }
    }


    if (isset($_POST['shareReq'])) {
        $docId = sanitizeInput($_POST['docId']);
        $collaboratorId = $_POST['collaboratorId'];
        $operation = $_POST['status'];

        if ($operation == 'Share') {
            $result = shareDocument($pdo, $docId, $collaboratorId);
        } else if ($operation == 'Unshare') {
            $result = unshareDocument($pdo, $docId, $collaboratorId);
        }

        if ($result) {
            echo $operation;
        } else {
            echo "Error sharing document";
        }
    }

    // change title
    if (isset($_POST['changeTitleReq'])) {

        $docId = sanitizeInput($_POST['docId']);
        $newTitle = sanitizeInput($_POST['docTitle']);

        $result = changeDocumentTitle($pdo, $docId, $newTitle);

        if ($result) {
            echo $newTitle;
        } else {
            echo "Error changing title";
        }
    }


    /* --- MESSAGES --- */
    if (isset($_POST['messageReq'])) {

        $message = sanitizeInput($_POST['message']);
        $docId = sanitizeInput($_POST['docId']);
        $userId = $_SESSION['user_id'];

        $result = sendMessage($pdo, $docId, $userId, $message);

        if ($result) {

            $allMessages = getMessages($pdo, $docId);

            foreach ($allMessages as $msg) {

                echo "<div class='space-y-4 p-4'>
                        <span class='font-semibold text-lg'>{$msg['username']}</span> <span class='text-xs text-gray-500'>{$msg['date_sent']}</span>
                        <div class='w-[90%] mx-auto'>{$msg['msg_content']}</div>
                    </div>";
            }
        } else {
            echo "Error sending message";
        }

    }

?>