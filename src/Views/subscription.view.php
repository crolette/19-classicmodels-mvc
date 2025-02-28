<h1>Subscription</h1>

<form method="post" action="" class="row g-2">
    <div>
        <label for="email" class="form-label">Username</label>
        <input type="text"  class="form-control" name="username" id="username" pattern="[a-zA-Z0-9]+" title="Only letters and numbers are allowed." maxlength="30" required>
    </div>
    <div>
        <label for="email" class="form-label">Email</label>
        <input type="email"  class="form-control" name="email" id="email" required>
    </div>
    <div>
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control"  name="password" id="password" required>
    </div>
    <input type="submit" value="Create new account" class="btn btn-primary mt-4">
</form>


<?php if (isset($_SESSION['errorMessage'])):?>
    <div class="alert alert-danger mt-2">
        <?php echo htmlspecialchars($_SESSION['errorMessage']);?>
    </div>
<?php endif;?>

