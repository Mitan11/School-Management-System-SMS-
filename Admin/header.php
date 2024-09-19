<?php
// session_start();
$site_url = 'http://localhost/School-Management-System%20-%20Copy/';
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin'){
        $user_type = $_SESSION['user_type'];
        header('Location: /School-Management-System - Copy/'.ucwords($user_type).'/dashboard.php');
    }
} 
else {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard</title>
    <!-- FavIcon -->
    <link rel="shortcut icon" href="../Assets/imgs/favicon.png" type="image/x-icon">
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- DataTable JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap CDN -->
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">