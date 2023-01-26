<?php
session_start();

$r1 = filter_input(INPUT_POST, "r1", FILTER_VALIDATE_INT);
$r2 = filter_input(INPUT_POST, "r2", FILTER_VALIDATE_INT);
$r3 = filter_input(INPUT_POST, "r3", FILTER_VALIDATE_INT);
$r4 = filter_input(INPUT_POST, "r4", FILTER_VALIDATE_INT);
$r5 = filter_input(INPUT_POST, "r5", FILTER_VALIDATE_INT);
$r6 = filter_input(INPUT_POST, "r6", FILTER_VALIDATE_INT);

include("connection.php");

$sql1 = "INSERT INTO random (user_id, r1, r2, r3, r4, r5, r6) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql1)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "iiiiiii",
                        $_SESSION['userid'],
                       $r1,
                       $r2,
                       $r3,
                       $r4, 
                       $r5, 
                       $r6);

mysqli_stmt_execute($stmt);


header( 'Location: serendipity.html' );
?> 