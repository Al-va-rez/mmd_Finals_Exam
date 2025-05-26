<?php
    require_once 'core/dbConfig.php';

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
    } else {
        header('Location: login.php');
    }
    
?>