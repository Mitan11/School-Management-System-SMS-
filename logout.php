<?php
// Start a session to access session variables
session_start();
// Destroy the session to log out the user 
session_destroy();

?>
<script>
    localStorage.setItem('toastMessage', 'You have successfully logged out!');
    window.location.href = 'index.php';
</script>
<?php
exit; // Terminate the script to ensure the redirect happens immediately
?>