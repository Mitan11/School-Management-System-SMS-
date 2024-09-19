<?php
    // Start a session to access session variables
    session_start();
    
    // Destroy the session to log out the user
    session_destroy();
    
    // Redirect the user to the index page after logging out
    header('Location: index.php');
    exit; // Terminate the script to ensure the redirect happens immediately
?>
