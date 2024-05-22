<?php 
	$router->map('GET', '/', ['App\Controllers\HomeController', 'index'], 'home');

	// User
	$router->map('GET', '/login-page',['App\Controllers\LoginController', 'login'] , 'login');
	$router->map('POST', '/login-page',['App\Controllers\LoginController', 'loginUser'] , 'loginUser');

	$router->map('GET', '/subscription', ['App\Controllers\SubscriptionController', 'subscription'], 'subscription');
	$router->map('POST', '/subscription', ['App\Controllers\SubscriptionController', 'postUser']);

	$router->map('GET', '/logout',['App\Controllers\SessionController', 'logoutSession'] , 'logout');
	
	$router->map('GET', '/user-profile',['App\Controllers\UserController', 'showUserProfile'] , 'user-profile');
	$router->map('POST', '/user-profile',['App\Controllers\UserController', 'changePasswordUser'] );

	// Product

	$router->map('GET', '/product-page/id=[*:productId]', ['App\Controllers\ProductController', 'showProduct']);
	$router->map('POST', '/product-page/id=[*:productId]', ['App\Controllers\ProductController', 'postComment']);
	$router->map('POST', '/product-page/id=[*:productId]&add-to-favorite', ['App\Controllers\ProductController', 'addToFavorite']);

?>