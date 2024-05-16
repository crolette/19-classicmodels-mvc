<?php 
declare(strict_types=1);

	require_once '../vendor/autoload.php';
	$heading = "Product";
	require "../views/product.view.php";
	use app\Controllers\ProductController;
?>

<?php 
    $newProduct = new ProductController;
    $newProduct->testProduct();
    var_dump($newProduct);
?>

 
