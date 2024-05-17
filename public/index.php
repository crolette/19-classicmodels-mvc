<?php 
	require_once '../vendor/autoload.php';
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	use \AltoRouter as Router;
use App\Controllers\HomeController;

	$router = new Router();
		

	// require('../config/routes.php');
	    $router->map('GET', '/', ['App\Controllers\HomeController', 'index'], 'home');
	$router->map('GET', '/product-page/[*:productId]', ['App\Controllers\ProductController', 'showProduct']);
	$router->map('GET', '/subscription', ['App\Controllers\SubscriptionController', 'subscription'], 'subscription');
	$router->map('GET', '/loginpage',['App\Controllers\LoginController', 'login'] , 'login');
	// $router->map('GET', '/', 'home', 'home');
	$match = $router->match();
	// phpinfo();

	var_dump($match);
	
	if(is_array($match)) {
		require('../src/Views/partials/header.php');
		$controller = $match['target'][0];
		$action = $match['target'][1];
		

		if(class_exists($controller)) {
			$controllerInstance = new $controller;
		} if(method_exists($controllerInstance, $action)) {
			$params = array_values($match['params']);
			call_user_func_array([$controllerInstance, $action], $params);
		} 
	} else {
		require ('errors/404.php');
	}

	require('../src/Views/partials/footer.php');

?>




