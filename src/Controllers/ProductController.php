<?php 
declare(strict_types=1);
namespace App\Controllers;



use App\Models\Database;


class ProductController
{
    public function showProduct($params) {
        var_dump($params);
       if(empty($_GET["code"]) || !isset($_GET["code"])) {
        echo "url incorrect";
        exit;
    } else {
        $code = $_GET['code'];
        $product = new Database;
        $product->getProduct($code);
    }
    }
}


?>