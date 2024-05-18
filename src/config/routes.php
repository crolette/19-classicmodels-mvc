<?php 
	$router->map('GET', '/', ['App\Controllers\HomeController', 'index'], 'home');

	// Login
	$router->map('GET', '/login-page',['App\Controllers\LoginController', 'login'] , 'login');
	$router->map('POST', '/login-page',['App\Controllers\LoginController', 'loginUser'] , 'loginUser');
	$router->map('GET', '/subscription', ['App\Controllers\SubscriptionController', 'subscription'], 'subscription');
	$router->map('POST', '/subscription', ['App\Controllers\SubscriptionController', 'postUser']);
	$router->map('GET', '/logout',['App\Controllers\SessionController', 'logoutSession'] , 'logout');

	// Product

	$router->map('GET', '/product-page/[*:productId]', ['App\Controllers\ProductController', 'showProduct']);
	$router->map('POST', '/product-page/[*:productId]', ['App\Controllers\ProductController', 'postComment']);

?>