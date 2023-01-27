<?php
    session_start();

    error_reporting(E_ALL ^ E_NOTICE);  

    include('connection.php');
    $sql = "SELECT * FROM rec WHERE user_id = '".$_SESSION['userid']."'";            
    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_assoc($result);
    
?>