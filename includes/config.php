<?php

    $db_connection = mysqli_connect('localhost','root','','SchoolManagementSystem');

    if(!$db_connection){
        echo "Connection Failed";
        exit;
    }
        session_start();
    include('functions.php')

?>