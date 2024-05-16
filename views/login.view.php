<?php require "partials/header.php"; ?>
<?php require "partials/banner.php";?>
<?php 
$message = '' ; 
require_once('../controllers/auth.php')
?>

<form method="post" action="">
    <label for="email">Username</label>
    <input type="text" name="username" id="username" pattern="[a-zA-Z0-9]+" title="Only letters and numbers are allowed." required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Login">
</form>

<?= $message ?>

<?php require "partials/footer.php"; ?>
