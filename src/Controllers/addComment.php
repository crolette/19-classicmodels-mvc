<?php 
    require_once('config.php');
    // require_once('connexion.php');

        if(isset($_POST['comment']) || !empty($_POST['comment'])) {
            
            $userId = $user['id'];
            $productCode = $product['productCode'];
            $comment = strip_tags($_POST['comment']);

            try { 
                $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $statement = $db->prepare('INSERT INTO comments (comment, userId, productId) VALUES (:comment, :userId, :productId)');
                $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
                $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
                $statement->bindParam(':productId', $productCode, PDO::PARAM_STR);
                $statement->execute();
                $db->commit();
                $message = 'Comment added';
                
            } catch (Exception $e) {
                echo $e->getMessage();
                $message = 'Comment couldn\'t be added';
                    throw $e;
                    $db->rollBack();
                    exit;
                } finally {
                    // close the connection to the db and the query
                    $db = null;
                    $statement = null;
                }
            }
        

    
?>