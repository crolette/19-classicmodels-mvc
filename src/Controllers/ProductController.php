<?php 
declare(strict_types=1);
namespace App\Controllers;

use App\Models\Products;

class ProductController
{
    public function __construct() {
        $_SESSION['errorMessage'] = null;
        $_SESSION['successMessage'] = null;
    }

    public function showProduct(array $params) {
        $parameters=explode('&', $params['productId']);
        $productCode = $parameters[0];
        
            
            if(empty($productCode) || !isset($productCode)) {
                $_SESSION['errorMessage'] = "This product does not exist";
                exit;
            } else {
                $db = new Products;
                if(in_array("add-to-favorite",$parameters)) {
                    $favoriteUser = $db->addToFavorite($productCode, $_SESSION['user']['id']);
                }
                elseif(isset($_SESSION['user']['id'])) {
                    $favoriteUser = $db->getFavorite($productCode, $_SESSION['user']['id']);
                }
                if(in_array("remove-from-favorite",$parameters)) {
                    $favoriteUser = $db->removeFavorite($productCode, $_SESSION['user']['id']);
                }
                $comments = $db->getComments($productCode);
                $product = $db->getProductByProductCode($productCode);
                $db->closeDbConnection();
                require '../src/Views/product.view.php';
        }
    }

    public function postComment(array $params) {

        $postDate = date('Y-m-d H:i:s', time());

        if(isset($_POST['comment']) || !empty($_POST['comment'])) {
            $comment = strip_tags($_POST['comment']);
            $comment = htmlspecialchars($comment);
            
            $db = new Products;
            $response = $db->postComment($comment, $_SESSION['user']['id'], $params['productId'], $postDate);
            if (isset($response['error'])) {
                $_SESSION['errorMessage'] = $response['error'];
            } else {
                $_SESSION['successMessage'] = $response['success'];
            }
            // $db->closeDbConnection();
            self::showProduct($params);
        }
    }



}


?>