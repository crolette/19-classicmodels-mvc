<?php 
    $GLOBALS['pageTitle'] = 'Classic Models - User profile' ;
	$GLOBALS['pageDescription'] = 'Classic Models - User profile';
?>

<h1>My Profile - <?= $user['username'] ?></h1>

    <table class="table">
        <tr>
            <td>Username:</td>
            <td><?= $user['username'] ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?= $user['email'] ?></td>
        </tr>
        <tr>
            <td>Member since:</td>
            <td><?= $user['subscription_date'] ?></td>
        </tr>
    </table>
    <h2>My favorite cars</h2>
    <?php if($favoriteCars == null) :?>
    <p>No favorite car yet</p>
    <?php else :?>
    <table class="table">
        <?php foreach($favoriteCars as $favoriteCar) : ?>
        <tr>
            <a href="/product-page/id="<?= $favoriteCar['productCode'] ?>></a>
            <td><?=$favoriteCar['productName'] ?> (<?=$favoriteCar['productCode'] ?>) </td>
        </tr>
        <?php endforeach;?>
    </table>
    <?php endif;?>
    



    <button class="btn btn-secondary" id="change-pass" >Change password</button>
    
     <?php if (isset($_SESSION['errorMessage'])):?>
    <form action="" method="post" id="change-pass-form" class="row g-2 mt-2">
        <?php else:?>
            <form action="" method="post" id="change-pass-form" class="row g-2 mt-2 d-none">
        <?php endif;?>
        <label for="old-pass" class="form-label">Old password</label>
        <input type="password" id="old-pass" class="form-control" name="old-pass" required >
        <label for="new-pass" class="form-label">New password</label>
        <input type="password" id="new-pass" class="form-control" name="new-pass" required >
        <label for="confirm-pass" class="form-label">Confirm new password</label>
        <input type="password" id="confirm-pass" class="form-control" name="confirm-pass" required>
        <button type="submit" class="btn btn-primary form-label">Change my password</button>
    </form>

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

    

    <script>
        let changePassButton = document.querySelector("#change-pass");
        let changePassForm = document.querySelector("#change-pass-form")

        changePassButton.addEventListener('click', (e) => {
            changePassForm.classList.toggle("d-none");
        })
    </script>

</form>


