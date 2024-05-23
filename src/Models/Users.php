<?php 
declare(strict_types=1);
namespace App\Models;
use \PDO;
use \Exception;


ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Users extends Database
{
    


    public function getEmail(string $email) {

        $sql = 'SELECT email 
                FROM users 
                WHERE email = :email';

        try {

            $statement = $this->db->prepare($sql);
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
                // close the query
                $statement = null;
            }
    }

    public function getUserInfos($username) {

        $sql = 'SELECT username, email, subscription_date 
                FROM users 
                WHERE username = :username';

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            return $user;

        } catch (Exception $e) {
                return ['error' => $e->getMessage()];
        } finally {
                // close the connection to the db and the query
                $statement = null;
            }
    }

    public function getUserByUsername(string $username) {

            $sql = 'SELECT username, id, password 
                    FROM users 
                    WHERE username = :username';

            try {
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':username', $username, PDO::PARAM_STR);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                // echo 'USER : ';
                // var_dump($user);
                return $user;
            } catch (Exception $e) {
                    return ['error' => $e->getMessage()];
            } finally {
                    $statement = null;
                }
    }



    public function postUser(string $password, string $email, string $username, string $subscriptionDate) {
        $sql = 'INSERT INTO users (username, email, password, subscription_date) 
                VALUES (:username, :email, :pass, :subscriptionDate)';

        try {
                $this->db->beginTransaction();
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':username', $username, PDO::PARAM_STR);
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->bindParam(':pass', $password, PDO::PARAM_STR);
                $statement->bindParam(':subscriptionDate', $subscriptionDate, PDO::PARAM_STR);
                $statement->execute();
                $id = $this->db->lastInsertId();
                echo "ID <br><br>";
                var_dump($id);
                $this->db->commit();
                return $id;
                
            } catch (Exception $e) {
                echo "ERROR";
                $this->db->rollBack();
                return ['error' => $e->getMessage()];
            } finally {
                    // close the connection to the db and the query
                    $statement = null;
                }

    }

    public function getUserPassword(string $password, string $username) {

        $sql = 'SELECT password, password 
                FROM users 
                WHERE username = :username';

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            return $password = $statement->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updatePassword(string $newPassword) {
        echo "new password";

        $sql = 'UPDATE users
                SET password = :newPassword
                WHERE id= :userId';

        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':newPassword', $newPassword);
            $stmt->bindParam(':userId', $_SESSION['user']['id']);
            $stmt->execute();
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    


}

?>