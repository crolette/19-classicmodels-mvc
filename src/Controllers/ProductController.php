<?php 
declare(strict_types=1);
namespace App\Controllers;

use \time;
use App\Models\Database;

class ProductController
{
    public function __construct() {
        $_SESSION['errorMessage'] = null;
        $_SESSION['successMessage'] = null;
    }

    public function showProduct(array $params) {
        $productCode = $params['productId'];
        
        if(empty($productCode) || !isset($productCode)) {
            echo "url incorrect";
            exit;
        } else {
            $db = new Database;
            $comments = $db->getComments($productCode);
            $product = $db->getProductByProductCode($productCode);
            $db->closeDbConnection();
            require '../src/Views/product.view.php';
        }
    }

    public function postComment(array $params) {

        $postDate = date('Y-m-d H:i:s', time());
        var_dump($postDate);

        if(isset($_POST['comment']) || !empty($_POST['comment'])) {
            $comment = strip_tags($_POST['comment']);
            $comment = htmlspecialchars($comment);
            
            $db = new Database;
            $response = $db->postComment($comment, $_SESSION['user']['id'], $params['productId'], $postDate);
            if (isset($response['error'])) {
                $_SESSION['errorMessage'] = $response['error'];
            } else {
                $_SESSION['successMessage'] = $response['success'];
            }
            self::showProduct($params);
        }
        

    }
}


?>