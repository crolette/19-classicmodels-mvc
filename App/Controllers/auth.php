<?php 
    require_once('connexion.php');
    require('../utils/sanitizeUsername.php');
    require('createSession.php');

    if(isset($_POST['username'], $_POST['password'])) {
        $username = sanitize_username($_POST['username']);
    
        try {
            

            $statement = $db->prepare('SELECT username, id, password FROM users WHERE username = :username');
            
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            var_dump($user);

            if($user) {
                if(password_verify($_POST['password'], $user['password'])) {
                    createSession($username, $user['id']);
                    header("Location: /17-PHP-Basics/Forms/10-PDO/index.php");
                } 
            } 

                    $message = "Wrong username or password";


        } catch (Exception $e) {
                echo $e->getMessage();
                throw $e;
                return false;
        } finally {
                // close the connection to the db and the query
                $db = null;
                $statement = null;
            }

        }

?>

