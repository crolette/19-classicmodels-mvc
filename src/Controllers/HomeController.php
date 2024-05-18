<?php 
declare(strict_types=1);
namespace App\Controllers;
use App\Models\Database;

class HomeController
{
    public function __construct() {
        // echo "Hello HomeController";
    }

    public function index() {
        $db = new Database();
        $products = $db->getAllProducts();
        require '../src/Views/home.view.php';
    }
}

?>