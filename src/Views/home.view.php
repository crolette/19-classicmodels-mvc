<?php 
	// require_once '../vendor/autoload.php';
	// require "partials/header.php"; 
	// require "partials/banner.php";
	// require_once('../src/Controllers/getAllProducts.php')
	
?>
	<h1>Home</h1>

	<ul>
	<?php 
	// var_dump($_SERVER);
	
	foreach ($products as $product):
	?>
	<li>
        <a href="/product-page/<?= $product["productCode"]?>">
		<?= $product["productName"]?>
        </a>
	</li>
	<?php 
	endforeach;?>
	</ul>


<?php 
// require "partials/footer.php"; 
?>
