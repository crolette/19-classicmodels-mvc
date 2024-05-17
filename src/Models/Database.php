<?php 
declare(strict_types=1);
namespace App\Models;
use \PDO;
use \Exception;
require_once('config.php');


class Database
{
    private $db;

    public function __construct() {
        
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', '1');
        // error_reporting(E_ALL);
        try {
            $this->db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    public function getAllProducts() {
        
        echo '<br>GetAllProducts<br>';
         	try {
            
            $statement = $this->db->prepare("SELECT * FROM products");
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
            exit;
        } finally {
            // close the connection to the db and the query
            $this->db = null;
            $statement = null;
        }
    }

    public function getProduct($code) {
       
        var_dump($code);

    	try {
		//  $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
        //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $this->db->prepare('SELECT * from products WHERE productCode = :codeProduct');
        $statement->bindParam(':codeProduct', $code, PDO::PARAM_STR);
        $statement->execute();
		// $statement = $db->prepare("SELECT * FROM products WHERE productCode = ?");
		// $statement->execute([$_GET['code']]);
		$product = $statement->fetch(PDO::FETCH_ASSOC);
		if(!$product) {
                echo "This product does not exist.";
       			exit;
            } else {
                return true;
            }
            return $product;
	} catch (Exception $e) {
		echo $e->getMessage();
		throw $e;
		exit;
	} finally {
		// close the connection to the db and the query
		$this->db = null;
		$statement = null;
	}
  
    }

    public function getComments($productCode) {
    	try {
		$statement = $this->db->prepare("SELECT comment, username
                                    FROM comments
                                    JOIN users
                                    WHERE comments.userId = users.id
                                    AND comments.productId = :productId");
        $statement->bindParam(':productId', $productCode);
		$statement->execute();
		return $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		echo $e->getMessage();
		throw $e;
		exit;
	} finally {
		// close the connection to the db and the query
		$this->db = null;
		$statement = null;
	}
    }

}

?>