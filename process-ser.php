<?php
session_start();

$s1 = filter_input(INPUT_POST, "s1", FILTER_VALIDATE_INT);
$s2 = filter_input(INPUT_POST, "s2", FILTER_VALIDATE_INT);
$s3 = filter_input(INPUT_POST, "s3", FILTER_VALIDATE_INT);
$s4 = filter_input(INPUT_POST, "s4", FILTER_VALIDATE_INT);
$s5 = filter_input(INPUT_POST, "s5", FILTER_VALIDATE_INT);
$s6 = filter_input(INPUT_POST, "s6", FILTER_VALIDATE_INT);

include("connection.php");

$sql1 = "INSERT INTO serendipity (user_id, s1, s2, s3, s4, s5, s6) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql1)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "iiiiiii",
                        $_SESSION['userid'],
                       $s1,
                       $s2,
                       $s3,
                       $s4, 
                       $s5, 
                       $s6);

#mysqli_stmt_execute($stmt);

header( 'Location: fine.html' );

?> 