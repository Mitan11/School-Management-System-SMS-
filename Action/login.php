<?php include('../includes/config.php'); ?>
<?php
// Check if the login form has been submitted
if (isset($_POST['login'])) {
    // Retrieve the email and password from the POST request
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    $pass_md5 = md5($pass);

    $query = mysqli_query($db_connection,"SELECT * FROM `user_accounts` WHERE email = '$email' AND password = '$pass_md5';");

    if(mysqli_num_rows($query)>0){
        $user = mysqli_fetch_object($query);
        $_SESSION['login'] = true;
        $_SESSION['session_id'] = uniqid();
        $user_type = $user->user_type;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['toastMessage'] = "Logged in successfully";    
        header('Location:../'.ucwords($user_type).'/dashboard.php');
        exit();
    }
    // Check if the provided email and password match the hardcoded admin credentials
    else if ($email == 'admin@gmail.com' && $pass == 'admin123') {

        // Set a session variable to indicate the user is logged in
        $_SESSION['login'] = true;
        // Redirect to the homepage
        $_SESSION['toastMessage'] = "Logged in successfully";    
        header('Location:../Admin/dashboard.php');
        }
        else {
        $_SESSION['toastMessage'] = "incorrect email or password";    
        header('Location: ../index.php');
        // Display an error message if the credentials are incorrect
        // echo "Invalid Email or Password";
    }
}
?>
