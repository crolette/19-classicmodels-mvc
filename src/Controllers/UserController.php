<?php 
namespace App\Controllers;

use \date;
use App\Models\Users;
use is;

class UserController {

     public function __construct() {
        $_SESSION['errorMessage'] = null;
        $_SESSION['successMessage'] = null;
    }


    public function showUserProfile() {
        echo "showUserProfile";
        $username = $_SESSION['user']['username'];
        $db = new Users();
        $user = $db->getUserInfos($username);
        

        require dirname(__DIR__) . '/Views/user-profile.php';
    }

    public function changePasswordUser() {
        echo "changepassworduser";

        if(empty($_POST['old-pass']) || empty($_POST['new-pass']) || empty($_POST['confirm-pass'])) {
            $_SESSION['errorMessage'] = "Fill in all fields";
        } elseif($_POST['confirm-pass'] !== $_POST['new-pass']){
                $_SESSION['errorMessage'] = "Passwords do not match!";
        } else {
            $db = new Users();
            //TODO verify if new password is not the same as the old password
            $newPassword = password_hash($_POST['new-pass'], PASSWORD_DEFAULT);
            $oldPassword = $db->getUserPassword($_POST['old-pass'], $_SESSION['user']['username']);
            // var_dump($newPassword);
            // echo '<br>';
            // var_dump($oldPassword['password']);
            if(password_verify($_POST['old-pass'], $oldPassword['password'])) {
                if($db->updatePassword($newPassword)) {
                    $_SESSION['successMessage'] = "Password changed";
            } else {
                $_SESSION['errorMessage'] = "Incorrect password";
            }
            
        }

        }

        self::showUserProfile();

    }

}

?>