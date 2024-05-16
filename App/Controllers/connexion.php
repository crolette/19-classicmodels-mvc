<?php 
require_once('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
$db=null;

try {
    global $db;
            $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
		echo $e->getMessage();
		throw $e;
}

?>