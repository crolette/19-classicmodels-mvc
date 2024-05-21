<?php 
declare(strict_types=1);
namespace App\Controllers;
use App\Models\Products;

class HomeController
{
    public function __construct() {
        // echo "Hello HomeController";
    }

    public function index() {
        $db = new Products();
        $products = $db->getAllProducts();
        if(isset($_SESSION['user']['id'])) {
            $favorites = $db->getFavoritesProductCodeOfUser(intval($_SESSION['user']['id']));
        }

        require '../src/Views/home.view.php';
    }
}

?>