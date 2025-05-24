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
            $username_FromDB = $check_User['userInfo']['username'];
            $password_FromDB = $check_User['userInfo']['password'];

            if (password_verify($password, $password_FromDB)) {

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
?>