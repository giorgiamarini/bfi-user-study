<?php
session_start();
$p1 = filter_input(INPUT_POST, "p1", FILTER_VALIDATE_INT);
$p2 = filter_input(INPUT_POST, "p2", FILTER_VALIDATE_INT);
$p3 = filter_input(INPUT_POST, "p3", FILTER_VALIDATE_INT);
$p4 = filter_input(INPUT_POST, "p4", FILTER_VALIDATE_INT);
$p5 = filter_input(INPUT_POST, "p5", FILTER_VALIDATE_INT);
$p6 = filter_input(INPUT_POST, "p6", FILTER_VALIDATE_INT);


include("connection.php");

$sql1 = "INSERT INTO pop (user_id, p1, p2, p3, p4, p5, p6) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql1)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "iiiiiii",   
                        $_SESSION['userid'],
                       $p1,
                       $p2,
                       $p3,
                       $p4, 
                       $p5, 
                       $p6);

mysqli_stmt_execute($stmt);

header( 'Location: rand.html' );
?> 