<?php 
    // require_once('connexion.php');
    require_once('config.php');

    require ('../utils/sanitizeUsername.php');
    require ('getUser.php');
    require ('getEmail.php');
    require ('createSession.php');
global $db;
    if(isset($_POST['password'], $_POST['email'], $_POST['username'])) {
        // var_dump($_POST);
            $username = sanitize_username($_POST['username']);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            var_dump($email);
            if (getUser($username)) {
                $message = "User already exists";
            } elseif(getEmail($email)) {
                $message = "E-mail already registered";
            } else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                
                try {
                // $db->beginTransaction();
               $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :pass)');
                $statement->bindParam(':username', $username, PDO::PARAM_STR);
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->bindParam(':pass', $password, PDO::PARAM_STR);
                $statement->execute();
                $id = $db->lastInsertId();
                // $db->commit();
                
                createSession($username, $id);
                    header("Location: /17-PHP-Basics/Forms/10-PDO/index.php");
            } catch (Exception $e) {
                echo $e->getMessage();
                    throw $e;
                    // $db->rollBack();
                    exit;
                } finally {
                    // close the connection to the db and the query
                    $db = null;
                    $statement = null;
                }
            }
    }
?>