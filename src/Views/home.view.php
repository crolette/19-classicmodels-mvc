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
			<a href="/product-page/<?= $product["productCode"]?>">
			<?= $product["productName"]?>
			</a>
		</td>
	</tr>
	<?php 
	endforeach;?>
	</table>

