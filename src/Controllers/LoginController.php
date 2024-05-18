<?php 
namespace App\Controllers;
use App\Controllers\Sanitizer as SANITIZE;
use App\Controllers\SessionController;
use App\Models\Users;

class LoginController {

    public function __construct() {
        $_SESSION['errorMessage'] = null;
        $_SESSION['successMessage'] = null;
    }

    public function login() {
        require '../src/Views/login.view.php';
    }

    public function loginUser() {
        if(isset($_POST['username'], $_POST['password'])) {
            $username = SANITIZE::sanitize_username($_POST['username']);
            $db = new Users();
            $user = $db->getUserByUsername($username);
            // echo 'USER : ';
            // var_dump($user);
            // echo '<br>';
            if (isset($user['error'])) {
                $_SESSION['errorMessage'] = $user['error'];
            } elseif ($user) {
                if(password_verify($_POST['password'], $user['password'])) {
                    SessionController::createSession($user['username'], $user['id']);
                    header('Location: /');
                } else {
                    $_SESSION['errorMessage'] = "Wrong username or password";
                }
            } elseif (!$user) {
                $_SESSION['errorMessage'] = "Wrong username or password";
            }
            require '../src/Views/login.view.php';
        }

    }

}

?>


    
    
    
