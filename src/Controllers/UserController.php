<?php 
namespace App\Controllers;

use is;
use \date;
use App\Models\Users;
use App\Models\Products;

class UserController {

     public function __construct() {
        $_SESSION['errorMessage'] = null;
        $_SESSION['successMessage'] = null;
    }


    public function showUserProfile() {
        $username = $_SESSION['user']['username'];
        $db = new Users();
        $user = $db->getUserInfos($username);
        $products = new Products;
        $favoriteCars = $products->getFavoritesOfUser($_SESSION['user']['id']);
        require dirname(__DIR__) . '/Views/user-profile.php';
    }

    public function changePasswordUser() {

        if(empty($_POST['old-pass']) || empty($_POST['new-pass']) || empty($_POST['confirm-pass'])) {
            $_SESSION['errorMessage'] = "Fill in all fields";
        } elseif($_POST['confirm-pass'] !== $_POST['new-pass']){
                $_SESSION['errorMessage'] = "Passwords do not match!";
        } else {
            $db = new Users();
            $newPassword = password_hash($_POST['new-pass'], PASSWORD_DEFAULT);
            $oldPassword = $db->getUserPassword($_POST['old-pass'], $_SESSION['user']['username']);
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