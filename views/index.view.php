<?php require "partials/header.php"; ?>
<?php require "partials/banner.php";?>
<?php require_once('controllers/getAllProducts.php')?>

	

	<ul>
	<?php 
	foreach ($products as $product):
	?>
	<li>
        <a href="./product/product.php?code=<?= $product["productCode"]?>">
		<?= $product["productName"]?>
        </a>
	</li>
	<?php 
	endforeach;?>
	</ul>


<?php require "partials/footer.php"; ?>
