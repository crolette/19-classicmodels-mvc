<?php 
    require_once('connexion.php');
    // require_once('config.php');

    function getUser($username) {
        global $db;
        try {
            //  $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
            // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $db->prepare('SELECT username FROM users WHERE username = :username');
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            echo 'USER : ';
            var_dump($user);
            if(!$user) {
                return false;
            } else {
                return true;
            }

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
