<?php 
    $router->map('GET', '/', 'home', 'home');
	$router->map('GET', '/product-page/[*:productId]', 'product');
	$router->map('GET', '/subscription', 'subscription');
	$router->map('GET', '/loginpage', 'login', 'login');

?>