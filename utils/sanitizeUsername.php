<?php 
function sanitize_username($username) {
    // Remove any character that is not a-z, A-Z, or 0-9
    $sanitized_username = preg_replace('/[^a-zA-Z0-9]/', '', $username);
    $sanitized_username = htmlspecialchars($sanitized_username);
    
    return $sanitized_username;
}

?>