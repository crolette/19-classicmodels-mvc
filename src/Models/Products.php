<?php 
declare(strict_types=1);
namespace App\Models;
use \PDO;
use \Exception;


ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Products extends Database
{

        public function getAllProducts() {
        
        $sql = "SELECT * 
                FROM products
                LIMIT 25";

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

    public function addToFavorite(string $productId, int $userId) {

        $sql = 'INSERT INTO favorites (productId, userId)
                VALUES (:productId, :userId)';

        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $this->db->commit();
            return true;
        } catch(Exception $e) {
            $this->db->rollBack();
            return ['error' => $e->getMessage()];
        } finally {
            $stmt = null;
        }
    }

    public function removeFavorite(string $productId, int $userId) {

        $sql = 'DELETE FROM favorites
                WHERE userId = :userId
                AND productId = :productId';

        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $this->db->commit();
            return false;
        } catch(Exception $e) {
            $this->db->rollBack();
            return ['error' => $e->getMessage()];
        } finally {
            $stmt = null;
        }
    }

    public function getFavorite(string $productId, int $userId) {

        $sql = "SELECT * 
                FROM favorites
                WHERE productId = :productId 
                AND userId = :userId";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_STR);
            $stmt->execute();
            $response = $stmt->fetch(PDO::FETCH_ASSOC);
            return !$response ? false : true;
           
            // return ['success' => 'Product added to your favorites.'];
        } catch(Exception $e) {
            return ['error' => $e->getMessage()];
        } finally {
            $stmt = null;
        }
    }

    public function getFavoritesOfUser(int $userId) {
        $sql = 'SELECT productName, productCode
                FROM favorites f
                JOIN products p
                WHERE f.productId = p.productCode
                AND f.userId = :userId';
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $favoriteCars = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $favoriteCars;
            
        } catch(Exception $e) {
            return ['error' => $e->getMessage()];
        } finally {
            $stmt = null;
        }
    }

       public function getFavoritesProductCodeOfUser(int $userId) {
        $sql = 'SELECT productCode
                FROM favorites f
                JOIN products p
                WHERE f.productId = p.productCode
                AND f.userId = :userId';
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $favoriteCars = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $favoriteCars;
            
        } catch(Exception $e) {
            return ['error' => $e->getMessage()];
        } finally {
            $stmt = null;
        }
    }



}

?>