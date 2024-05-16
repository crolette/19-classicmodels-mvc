# PDO

## Learning objectives
- Starting with PHP
	* How to connect PHP to a MySQL Database
	* Executing queries using prepared statements
	* Learn common security good practices
	* Handling errors


## Definition

The PHP Data Objects (PDO) extension defines a lightweight, consistent interface for accessing databases in PHP. 

PDO provides a data-access abstraction layer, which means that, regardless of which database you're using, you use the same functions to issue queries and fetch data. 

## Installation

PDO relies on database-specific drivers : PDO_MYSQL for MySQL, PDO_PGSQL for PostgreSQL, PDO_OCI for Oracle database, etc., to function properly.

In this course, we will use MySQL, so you need to have the *PDO_MYSQL* driver install with your PHP environment. 

If you had install XAMPP, the LAMP stack or the Docker environment given, it is already set up. 

## Use case : Classic Models

For this explanation, we need a database. You had already use one for a big requests exercice, the *Classic Models Database*.  

### Connexion

First of all, you need to etablish a connexion between, PHP & the DB. 

For that, we will instantiate a new object *PDO* in a `$db` variable :

```php
$db = new PDO("mysql:host=localhost;dbname=classicmodels;port=3306", "login", "password");
```

But, this connexion is not secure at all because we write directly the connexion infos. 

So, we will store infos in constant variables :

```php
define("HOST", "localhost");
define("DB", "classicmodels");
define("PORT", "3306");
define("LOGIN", "admin");
define("PASSWORD", "password");

$db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
```

### Display errors

We implemented the connexion, but how to know we're connected to the database? 

To display the errors, we have to had this piece of code (preferably at the top of our file): 

```php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
```

### The quest to the request 

There are several steps to follow to be able to make a secure request to a DB. Here, we will see all the steps.

#### Prepare statement

First, we have to prepare the request. That's where we write the SQL statement. 

```php 
$statement = $db->prepare("SELECT * FROM products");
```

#### Execute statement

```php 
$statement->execute();
``` 

These two methods **prepare** & **execute** are protection against SQL injections ! 

#### Fetch in the database

Now that, the request is made, we want to organise the datas we got.

> There are many ways you can retreive your data. Check on the documentation to know more about different methods of PDO Statement : https://www.php.net/manual/en/class.pdostatement.php#class.pdostatement


In our request `"SELECT * FROM products"`, I want all the rows from the table *products*. That's why I'll use the method *fetchAll()* :

```php 
$products = $statement->fetchAll();
``` 

Check the result in a `var_dump()`, You should have something like that : 


```php 
array(110) {
  [0]=>
  array(18) {
    ["productCode"]=>
    string(8) "S10_1678"
    [0]=>
    string(8) "S10_1678"
    ["productName"]=>
    string(37) "1969 Harley Davidson Ultimate Chopper"
    [1]=>
    string(37) "1969 Harley Davidson Ultimate Chopper"
    ["productLine"]=>
    string(11) "Motorcycles"
    [2]=>
    string(11) "Motorcycles"
    ...
  }
  [1]=>
  array(18) {
    ["productCode"]=>
    string(8) "S10_1949"
    [0]=>
    string(8) "S10_1949"
    ["productName"]=>
    string(24) "1952 Alpine Renault 1300"
    [1]=>
    string(24) "1952 Alpine Renault 1300"
    ["productLine"]=>
    string(12) "Classic Cars"
    [2]=>
    string(12) "Classic Cars"
    ...
  }
  [2]=>
  array(18) {
    ["productCode"]=>
    string(8) "S10_2016"
    [0]=>
    string(8) "S10_2016"
    ["productName"]=>
    string(21) "1996 Moto Guzzi 1100i"
    [1]=>
    string(21) "1996 Moto Guzzi 1100i"
    ["productLine"]=>
    string(11) "Motorcycles"
    [2]=>
    string(11) "Motorcycles"
    ...
  }

```

We have all the infos, we need, but a little bit too much, don't you think? Because, all the datas are duplicated. 


To fix that, we will use the argument `PDO::FETCH_ASSOC`. This argument return each row as an array indexed by column name.

> To know more about the argument you can use in a fetch method, check it out : https://www.php.net/manual/en/pdo.constants.php#pdo.constants.fetch-assoc

```php 
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
``` 


#### Display the result

Now, we can display all the products in our webpage, for example in a list : 

```php 
foreach ($products as $product) {
	echo "<li>" . $product["productName"] . "</li>";
}
``` 

`"productName"` refers to the column "productName" in the table *products*.


And that's it. You're now able to fetch data from DB using PDO ! 

---

In the next chapter, we will see how to catch errors from PDO. 