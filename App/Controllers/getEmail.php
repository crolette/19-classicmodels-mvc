<?php 
    // require_once('connexion.php');
// global $db;
    require_once('config.php');

    function getEmail($email) {
        echo $email;
        global $db;
        try {

             $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $db->prepare('SELECT email FROM users WHERE email = :email');
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();
            $email = $statement->fetch(PDO::FETCH_ASSOC);
            echo 'EMAIL : ';
            var_dump($email);
            if(!$email) {
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
