<?php 
        $arr_cookie_options = array (
					'cookie_lifetime' => 60, 
					'cookie_path' => '/', 
					'cookie_domain' => 'localhost', 
					'cookie_secure' => false,    
					'cookie_httponly' => false, 
					'cookie_samesite' => 'Lax' 
		);

    session_set_cookie_params(60);

    // TODO verify the lifetime of the session
    
    session_start($arr_cookie_options);
    
    $user = null;
    
    if(isset($_SESSION['user'])) {
        // print_r($_SESSION['user']);
        $user = $_SESSION['user'];
    } 
var_dump($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Models - <?= htmlspecialchars($heading) ?></title>
</head>
<body>

<header>
    <nav>
    	<ul>
        <li><a href="./index.php">Home</a></li>
        
            
            <?php if ($user === null): ?>
                <li><a href="./login.php">Login</a></li>
                <li><a href="./subscription.php">Subscription</a></li>
                <?php else: ?>
                    <li>Logged in as <?= htmlspecialchars($user['username']) ?></li>
                    <li><a href="./logout.php">Logout</a></li>
            <?php endif; ?>
      </ul>
    </nav>
</header>