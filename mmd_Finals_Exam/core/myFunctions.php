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
    function register($pdo, $username, $first_Name, $last_Name, $password) {

        $response = array();

        $check_User = check_UserExists($pdo, $username);

        
        if (!$check_User['result']) { // add user to database

            $sql = "INSERT INTO user_credentials (username, first_Name, last_Name, password) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$username, $first_Name, $last_Name, $password])) {
                $response = "Success";
            }

        } else { // user already registered
            $response = "User already registered";
        }

        return $response;
    }
?>