<?php
session_start();

$rating1 = intval(filter_input(INPUT_POST, "rating1", FILTER_VALIDATE_INT));
$rating2 = intval(filter_input(INPUT_POST, "rating2", FILTER_VALIDATE_INT));
$rating3 = intval(filter_input(INPUT_POST, "rating3", FILTER_VALIDATE_INT));
$rating4 = intval(filter_input(INPUT_POST, "rating4", FILTER_VALIDATE_INT));
$rating4 = intval(filter_input(INPUT_POST, "rating4", FILTER_VALIDATE_INT));
$rating5 = intval(filter_input(INPUT_POST, "rating5", FILTER_VALIDATE_INT));

include("connection.php");

$sql1 = "INSERT INTO ratings (user_id, rating1, rating2, rating3, rating4, rating5) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql1)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "iiiiii",
                        $_SESSION['userid'], 
                       $rating1,
                       $rating2,
                       $rating3,
                       $rating4, 
                       $rating5);

mysqli_stmt_execute($stmt);

$ser = floatval($_SESSION['serendipity']);
$python_output = exec("/Library/Frameworks/Python.framework/Versions/3.10/bin/python3 ./csv/algoritmo.py $ser $rating1 $rating2 $rating3 $rating4 $rating5 2>&1");
#print($python_output);
$my_array = json_decode($python_output, true);
#print($my_array);
$sql2= "INSERT INTO rec (user_id, rec1, rec2, rec3, rec4, rec5) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql2)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "iiiiii",
                        $_SESSION['userid'],
                       $my_array[0],
                       $my_array[1],
                       $my_array[2],
                       $my_array[3], 
                       $my_array[4]);

mysqli_stmt_execute($stmt);

header( 'Location: pop.html' );
?> 