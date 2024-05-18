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
                $_SESSION['errorMessage'] = "Username is too long (must be < 30 chars)";
            } else {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $db = new Users();
                if ($db->getUserByUsername($username)) {
                    $_SESSION['errorMessage'] = "User already exists";
                } elseif($db->getEmail($email)) {
                    $_SESSION['errorMessage'] = "E-mail already exists";
                } else {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $subscriptionDate = date('Y-m-d H:i:s', time());
                    $response = $db->postUser($password, $email, $username, $subscriptionDate);
                    echo "RESPONSE <br>";
                    var_dump($response);
                    if(isset($response['error'])) {
                        $_SESSION['errorMessage'] = $response['error'];
                    } 
                    else {
                        SessionController::createSession($username, $response);
                        header("Location: /");
                    }
            }
            }
        }
        self::subscription();
    }

}


?>