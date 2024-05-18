<?php 
	require_once '../vendor/autoload.php';
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	use \AltoRouter as Router;

	$router = new Router();
	
	define('CONFIG_PATH', dirname(__DIR__) . '/src/config/');
	require_once(CONFIG_PATH .'config.php');
	require CONFIG_PATH . 'routes.php';
	
	
	session_start($arr_cookie_options);   
    $userSession = null;
    if(isset($_SESSION['user'])) {
        $userSession = $_SESSION['user'];
    }

	$match = $router->match();

	if(is_array($match)) {
		$controller = $match['target'][0];
		$action = $match['target'][1];

		if(class_exists($controller)) {

			$controllerInstance = new $controller;

		} if(method_exists($controllerInstance, $action)) {
			
			ob_start();
			call_user_func_array([$controllerInstance, $action], [$match['params']]);
			$pageContent = ob_get_clean();
			
		} 
		require('../src/Views/partials/layout.php');
	} else {
		require ('errors/404.php');
	}
	
?>




