<?php 
    $GLOBALS['pageTitle'] = 'Classic Models - Login Page' ;
	$GLOBALS['pageDescription'] = 'Classic Models - Login Page';
?>

<h1>Login</h1>

<form method="post" action="">
    <label for="email" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="username" pattern="[a-zA-Z0-9]+" title="Only letters and numbers are allowed." maxlength="30" required>
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password" required>
    <input type="submit" value="Login" class="btn btn-primary">
</form>

<?php if (isset($_SESSION['errorMessage'])):?>
    <div class="alert alert-danger mt-2">
        <?php echo htmlspecialchars($_SESSION['errorMessage']);?>
    </div>
<?php endif;?>

