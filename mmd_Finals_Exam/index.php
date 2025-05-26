<?php
    require_once 'core/dbConfig.php';

    // user not in homepage but stil logged in
    if (isset($_SESSION['username']) && isset($_SESSION['role'])) {

        switch ($_SESSION['role']) {

            case 'Admin':
                header('Location: role_Admin/admin_Home1.php');
                break;
            
            case 'User':
                header('Location: role_User/user_Homepage.php');
                break;
           
            default:
                header('Location: login.php');
                break;
        }
    // user not logged in
    } else {
        header('Location: login.php');
    }
    
?>