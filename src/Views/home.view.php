<?php 
	$GLOBALS['pageTitle'] = 'Classic Models - Home';
	$GLOBALS['pageDescription'] = 'Home of Classic Models';
?>
	<h1>Home</h1>
	<table class="table table-striped table-hover">
	<?php 
	
	foreach ($products as $product):
	?>
	<tr>
        <td>
			<a href="/product-page/id=<?= $product["productCode"]?>">
			<?= $product["productName"]?>
			</a>

			  <?php if(isset($_SESSION['user']['id'])) : ?>
				<?php if(array_search($product['productCode'], array_column($favorites, 'productCode'))) :?>
					<a href="/product-page/id=<?= $product["productCode"]?>&remove-from-favorite">
					<i class="bi bi-star-fill text-warning" key=<?= $product["productCode"]?>></i> 
					</a>
					<?php else: ?>
						<a href="/product-page/id=<?= $product["productCode"]?>&add-to-favorite">
					<i class="bi bi-star text-warning" key=<?= $product["productCode"]?>></i> 
					</a>
				<?php endif;?>
    <?php endif;?>
	
		</td>
	</tr>
	<?php 
	endforeach;?>
	</table>

