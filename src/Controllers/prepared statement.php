<!-- prepared statement  -->
<?php
	// try {
	// 	$db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
	// 	$stmt = $db->prepare("INSERT INTO products (productName, productCode, productLine, productDescription, productScale, quantityInStock, buyPrice, MSRP, productVendor) VALUES (:name, :code, :line, :description, :scale, :quantity, :price, :msrp, :vendor)");
	// 	$stmt->bindParam(':name', $name);
	// 	$stmt->bindParam(':code', $code);
	// 	$stmt->bindParam(':line', $line);
	// 	$stmt->bindParam(':description', $description);
	// 	$stmt->bindParam(':scale', $scale);
	// 	$stmt->bindParam(':quantity', $quantity);
	// 	$stmt->bindParam(':price', $price);
	// 	$stmt->bindParam(':msrp', $msrp);
	// 	$stmt->bindParam(':vendor', $vendor);
	// 	// insert one row	
	// 	$name = 'firstTest';
	// 	$code = "S99_9998";
	// 	$line = "Planes";
	// 	$description = "This is a test product";
	// 	$scale = "1/99999";
	// 	$quantity = 25;
	// 	$price = 8888.88;
	// 	$msrp = 9999.99;
	// 	$vendor = "Min Lin Diecast";
	// 	$stmt->execute();
	// } catch (PDOException $e) {
	// 	// echo $e;
	// 	throw $e;
	// } finally {
	// 	// close the connection to the db and the query
	// 	$db = null;
	// 	$statement = null;
	// }
// ?>