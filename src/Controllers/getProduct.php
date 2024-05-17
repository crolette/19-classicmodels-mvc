<?php 
    require_once('connexion.php');
    // require_once('config.php');
	global $db;

    if(empty($_GET["code"]) || !isset($_GET["code"])) {
		global $db;
        echo "url incorrect";
        exit;
    }


    	try {
		//  $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
        //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $db->prepare('SELECT * from products WHERE productCode = :codeProduct');
        $statement->bindParam(':codeProduct', $_GET['code'], PDO::PARAM_STR);
        $statement->execute();
		// $statement = $db->prepare("SELECT * FROM products WHERE productCode = ?");
		// $statement->execute([$_GET['code']]);
		$product = $statement->fetch(PDO::FETCH_ASSOC);
		if(!$product) {
                echo "This product does not exist.";
       			exit;
            } else {
                return true;
            }
	} catch (Exception $e) {
		echo $e->getMessage();
		throw $e;
		exit;
	} finally {
		// close the connection to the db and the query
		$db = null;
		$statement = null;
	}


	ini_set('display_errors', 1);
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
?>