<?php 
    // $GLOBALS['message']='';

    // $GLOBALS['pageTitle'] = 'Classic Models - PRODUCT' ;
    $GLOBALS['pageTitle'] = 'Classic Models - Login Page' ;
	$GLOBALS['pageDescription'] = 'Classic Models - Login Page';
	// $GLOBALS['pageDescription'] = 'Beautiful car';
?>
<h1>Login</h1>

<form method="post" action="">
    <label for="email">Username</label>
    <input type="text" name="username" id="username" pattern="[a-zA-Z0-9]+" title="Only letters and numbers are allowed." maxlength="30" required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Login">
</form>

<?php if (isset($_SESSION['errorMessage'])):?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($_SESSION['errorMessage']);?>
    </div>
<?php endif;?>

