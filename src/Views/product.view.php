<?php 
    $GLOBALS['pageTitle'] = 'Classic Models - ' . $product["productName"] ;
	$GLOBALS['pageDescription'] = $product["productName"] . " - " . $product["productDescription"];
?>


    <h2><?= $product["productName"] ?> 
    <?php if(isset($_SESSION['user']['id']) && $favoriteUser) : ?>
        <a href="/product-page/id=<?= $product["productCode"]?>&remove-from-favorite">
        <button class="btn btn-secondary" id="favorite" data-favorite="checked" key=<?= $product["productCode"]?>><i class="bi bi-star-fill text-warning"></i></button>
        </a>
    <?php elseif(isset($_SESSION['user']['id'])) :?>
        <a href="/product-page/id=<?= $product["productCode"]?>&add-to-favorite">
        <button class="btn btn-secondary" id="favorite" data-favorite="checked" key=<?= $product["productCode"]?>><i class="bi bi-star-fill "></i></button>
        </a>
    <?php endif;?>

    </h2>
	
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
                Product Code : <?= $product["productCode"]?>
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
    <form method="post" action="/product-page/id=<?= $product["productCode"]?>" class="row g-2">
        <label for="comment" class="">Add a comment</label>
        <input type="text" name="comment" id="comment" class="form-control" maxlength="255">
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
        <ul class="list-group">
            <?php foreach($comments as $comment) :?>
                <li class="list-group-item d-flex flex-row justify-content-between">
                     <p><?= $comment['comment']?></p>
                     <div class="d-flex-inline flex-column align-items-end justify-content-center">

                         <p class="badge text-bg-light rounded-pill">from : <?= $comment['username']?></p>
                         <p class="badge text-bg-info rounded-pill"><?=$comment['postDate']?></p>
                        </div>
                    
                </li>
            <?php endforeach;?>
        </ul>
        <?php else: ?>
            <p>No comments for this product</p>
    <?php endif;?>
    </div>

<script defer>
    const favoriteBtn = document.querySelector('#favorite');

    favoriteBtn.addEventListener("click", (e) => {
        console.log(e.target);
        favoriteBtn.classList.toggle("text-warning");
        window.location.href = "id=<?= $product["productCode"]?>";
    })


</script>
