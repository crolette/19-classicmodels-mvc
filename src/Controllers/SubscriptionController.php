<?php 
namespace App\Controllers;
use App\Controllers\SessionController;
use App\Controllers\Sanitizer as SANITIZE;
use App\Models\Users;

class SubscriptionController
{
    public function __construct() {
        $_SESSION['errorMessage'] = null;
    }

    public function subscription() {
        require '../src/Views/subscription.view.php';
    }

    public function postUser() {
        if(isset($_POST['password'], $_POST['email'], $_POST['username'])) {
        // var_dump($_POST);
            $username = SANITIZE::sanitize_username($_POST['username']);
            if(strlen($username) > 30) {
                $_SESSION['errorMessage'] = "User must be < 30 chars";
                exit;
            }
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $db = new Users();
            if ($db->getUser($username)) {
                $_SESSION['errorMessage'] = "User already exists";
                exit;
            } elseif($db->getEmail($email)) {
                $_SESSION['errorMessage'] = "E-mail already exists";
                exit;
            } else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $response = $db->postUser($password, $email, $username);
                echo "RESPONSE <br>";
                var_dump($response);
                if(isset($response['error'])) {
                    $_SESSION['errorMessage'] = $response['error'];
                    exit;
                } 
                else {
                    SessionController::createSession($username, $response);
                    header("Location: /");
                }
            }
        }
        self::subscription();
    }

}


?>