<?php 
    $GLOBALS['pageTitle'] = 'Classic Models - ' . $product["productName"] ;
	$GLOBALS['pageDescription'] = $product["productName"] . " - " . $product["productDescription"];
?>


    <h2><?= $product["productName"] ?></h2>
	
    <div class="card">
    <div class="card-body">

    <p class="card-text">
                Description : <?= $product["productDescription"]?>
</p>
        <ul  class="list-group list-group-flush">
            <li  class="list-group-item">
                Product Line : <?= $product["productLine"]?>
            </li>
            <li class="list-group-item">
                Scale : <?= $product["productScale"]?>
            </li>
            <li class="list-group-item">
                Vendor : <?= $product["productVendor"]?>
            </li>
            
            <li class="list-group-item">
                Quantity in stock : <?= $product["quantityInStock"]?>
            </li>
            <li class="list-group-item">
                MSRP : <?= $product["MSRP"]?>€
            </li>
            
    
        </ul>
        </div>
    </div>

    <?php 
        if (isset($_SESSION['user'])):
    ?>
    <form method="post" action="" class="row g-2">
        <label for="comment" class="">Add a comment</label>
        <input type="text" name="comment" id="comment" class="form-control">
        <input type="submit" value="Add a new comment" class="btn btn-primary">
    </form>
                
    <?php endif;?>
    <?php if (isset($_SESSION['errorMessage'])):?>
    <div class="alert alert-danger mt-2">
        <?php echo htmlspecialchars($_SESSION['errorMessage']);?>
    </div>
    <?php endif;?>
    <?php if (isset($_SESSION['successMessage'])):?>
    <div class="alert alert-success mt-2">
        <?php echo htmlspecialchars($_SESSION['successMessage']);?>
    </div>
    <?php endif;?>
    
    <h2>Comments</h2>
    <?php if(count($comments) > 0) :?>
        <ul>
            <?php foreach($comments as $comment) :?>
                <li>
                    <?= $comment['username'] . " (".$comment['postDate'].")"?> : <?= $comment['comment']?> 
                </li>
            <?php endforeach;?>
        </ul>
        <?php else: ?>
            <p>No comments for this product</p>
    <?php endif;?>



