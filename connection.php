<?php
$host = "localhost";
$dbname = "bfi_db";
$username = "root";
$password = "";

ini_set('display_errors', 1);

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()){
    die("Could not connect to DB:" . mysqli_connect_errno());
}

?>