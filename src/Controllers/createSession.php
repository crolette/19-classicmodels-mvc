<?php 
require_once('config.php');

    function createSession($username, $id) {
        var_dump($username);
        
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
?>