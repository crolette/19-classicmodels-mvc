<?php 


    // Start the session
session_start();

// Unset all session variables
unset($_SESSION['user']);
// $_SESSION = array();


// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }

// Destroy the session
session_destroy();


header("Location: /17-PHP-Basics/Forms/10-PDO/index.php");
exit();


?>