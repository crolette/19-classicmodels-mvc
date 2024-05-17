<?php 
$message = '' ; 
// require_once('../controllers/auth.php')
?>
<h1>Login</h1>

<form method="post" action="">
    <label for="email">Username</label>
    <input type="text" name="username" id="username" pattern="[a-zA-Z0-9]+" title="Only letters and numbers are allowed." required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Login">
</form>

<?= $message ?>

