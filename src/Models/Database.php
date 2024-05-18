<?php 
declare(strict_types=1);
namespace App\Models;
use \PDO;
use \Exception;


ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Database
{
    private $db;

    public function __construct() {
        
        try {
            $this->db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

        public function closeDbConnection() {
        try {
            $this->db = null;

        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
            exit;
        }
    }

    public function getAllProducts() {
        
        $sql = "SELECT * 
                FROM products
                LIMIT 10";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $products;
            } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
            exit;
        } finally {
            // close the connection to the db and the query
            // $this->db = null;
            // $statement = null;
        }
    }

    public function getProductByProductCode(string $productCode) {
        // $code = $params['productId'];
       
        $sql = 'SELECT * 
                FROM products
                WHERE productCode = :codeProduct';

    	try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':codeProduct', $productCode, PDO::PARAM_STR);
            $statement->execute();
            $product = $statement->fetch(PDO::FETCH_ASSOC);
            if(!$product) {
                echo "This product does not exist.";
                exit;
            }
            return $product;
                    // return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
            exit;
        } finally {
            // close the connection to the db and the query
            // $this->db = null;
            $statement = null;
        }
  
    }

    public function getComments(string $productCode) {

        $sql = "SELECT comment, username, postDate
                FROM comments
                JOIN users
                WHERE comments.userId = users.id
                AND comments.productId = :productId
                ORDER BY postDate DESC";

    	try {
		$statement = $this->db->prepare($sql);
        $statement->bindParam(':productId', $productCode, PDO::PARAM_STR);
		$statement->execute();
		return $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		echo $e->getMessage();
		throw $e;
		exit;
	} finally {
		// close the connection to the db and the query
		// $this->db = null;
		$statement = null;
	}
    }



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

    public function getUser($username) {

        $sql = 'SELECT username FROM users 
                WHERE username = :username';

        try {
            $statement = $this->db->prepare($sql);
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


    public function postComment(string $comment, int $userId, string $productCode, $postDate) {
        $sql = 'INSERT INTO comments (comment, userId, productId, postDate) 
                VALUES (:comment, :userId, :productId, :postDate)';

            try { 
               
                $this->db->beginTransaction();
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
                $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
                $statement->bindParam(':productId', $productCode, PDO::PARAM_STR);
                $statement->bindParam(':postDate', $postDate, PDO::PARAM_STR);
                $statement->execute();
                $this->db->commit();
                return ['success' => 'Comment added.'];
                
            } catch (Exception $e) {
                $this->db->rollBack();
                    return ['error' => $e->getMessage()];
                } finally {
                    // close the connection to the db and the query
                    $statement = null;
                }
    }

    public function postUser(string $password, string $email, string $username) {
        $sql = 'INSERT INTO users (username, email, password) 
                VALUES (:username, :email, :pass)';

        try {
                $this->db->beginTransaction();
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':username', $username, PDO::PARAM_STR);
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->bindParam(':pass', $password, PDO::PARAM_STR);
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
    


}

?>