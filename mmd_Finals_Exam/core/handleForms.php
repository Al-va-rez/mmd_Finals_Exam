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

                if ($_SESSION['role'] == 'Admin') {
                    echo "Login as admin";
                } else if ($_SESSION['role'] == 'User') {
                    echo "Login as user";
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

        $accessControl = check_UserSuspended($pdo, $_SESSION['user_id']);

        if (!$accessControl) {

            $result = createDocument($pdo, $_SESSION['user_id']);

            if ($result) {
                echo "Document created";
            } else {
                echo "Error creating document";
            }

        } else {
            echo "Account is suspended";
        }
        
    }


    if (isset($_POST['saveReq'])) {
        $content = $_POST['content'];
        $docId = sanitizeInput($_POST['docId']);
        $userId = $_SESSION['user_id'];
        
        $result = saveDocument($pdo, $content, $docId, $userId);

        if ($result) {
            
            foreach ($result as $change) {

                echo "<div class=''>
                        <div>Done by: {$change['done_by']}</div>
                        <div>Changes made: {$change['changes_made']}</div>
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
?>