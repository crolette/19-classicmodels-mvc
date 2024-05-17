<?php 
require_once('config.php');


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