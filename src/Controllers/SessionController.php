<?php 
namespace App\Controllers;

class SessionController 
{

    public function __construct() {
    }

    public static function createSession(string $username, int $id) {
        
        global $arr_cookie_options;

        if (session_status() === PHP_SESSION_NONE) {
            // session_name('user');
            session_start($arr_cookie_options);
            $_SESSION['user'] = [
                'username' => $username,
                'id' => $id
            ];
        } else {
            if(!isset($_SESSION['user'])) {
                $_SESSION['user'] = [
                'username' => $username,
                'id' => $id
            ];
            }
        }
    }

    public static function logoutSession() {
        
        session_start();

        // Unset all session variables
        unset($_SESSION['user']);

        // Destroy the session
        session_destroy();

        header("Location: /");

    }
}

?>