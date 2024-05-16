<?php require "partials/header.php"; ?>
<?php require "partials/banner.php";?>
<?php require_once('../controllers/getProduct.php')?>
<?php $message='' ?>
<?php require "../controllers/addComment.php" ?>
<?php require "../controllers/getComments.php" ?>

    <h2><?= $product["productName"] ?></h2>
	
	<ul>
       
        <li>
            Product Line : <?= $product["productLine"]?>
        </li>
        <li>
            Scale : <?= $product["productScale"]?>
        </li>
        <li>
            Vendor : <?= $product["productVendor"]?>
        </li>
        <li>
            Description : <?= $product["productDescription"]?>
        </li>
        <li>
            Quantity in stock : <?= $product["quantityInStock"]?>
        </li>
        <li>
            MSRP : <?= $product["MSRP"]?>€
        </li>

        

    </ul>

    <?php var_dump($comments) ?>

    <?php 
            if (isset($user)):
        ?>
    <form method="post" action="">
        <label for="comment">Add a comment</label>
        <input type="text" name="comment" id="comment">
        <input type="submit" value="Add a new comment">
    </form>
                
    <?php endif;?>

    <?php if(count($comments) > 0) :?>
        <ul>

            <?php foreach($comments as $comment) :?>
                <li>
                    <?= $comment['username']?> : <?= $comment['comment']?> 
                </li>
                <?php endforeach;?>

            </ul>
            <?php endif;?>

<p><?= $message ?>Yes</p>

<?php require "partials/footer.php"; ?>
