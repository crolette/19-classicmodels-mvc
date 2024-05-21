<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $GLOBALS['pageDescription'] ?? "Classic Models" ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title><?= $GLOBALS['pageTitle'] ?? 'Mon site' ?></title>
</head>
<body>

<header class="container">
    <nav class="nav nav-pills justify-content-center">
    	<a class="nav-link" href="<?= $router->generate('home') ?>">Home</a>
        
            
            <?php if ($userSession === null): ?>
                <a class="nav-link" href="<?= $router->generate('login') ?>">Login</a>
                <a class="nav-link" href="<?= $router->generate('subscription') ?>">Subscription</a>
                <?php else: ?>
                    <p class="nav-link">Logged in as <?= htmlspecialchars($userSession['username']) ?></p>
                    <a class="nav-link" href="<?= $router->generate('logout') ?>">Logout</a>
                    <a class="nav-link" href="<?= $router->generate('user-profile') ?>">User Profile</a>
            <?php endif; ?>
      </ul>
    </nav>
    
</header>