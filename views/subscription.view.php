<?php require "partials/header.php"; ?>
<?php require "partials/banner.php";?>
<?php $message = '' ;
require_once('../controllers/postUser.php')
?>

<form method="post" action="">
    <label for="email">Username</label>
    <input type="text" name="username" id="username" pattern="[a-zA-Z0-9]+" title="Only letters and numbers are allowed." required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Create new account">
</form>

<span><?= $message ?></span>

<?php require "partials/footer.php"; ?>
