<?php
session_start();

include("connection.php");
include("questions.php");

$gender = filter_input(INPUT_POST, "gender", FILTER_VALIDATE_INT);
$age_range = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT);
$perweek = filter_input(INPUT_POST, "perweek", FILTER_VALIDATE_INT);
$genres = $_POST["genres"];
$education = filter_input(INPUT_POST, "edu", FILTER_VALIDATE_INT);
$profession = filter_input(INPUT_POST, "prof", FILTER_VALIDATE_INT);

$userid = uniqid($more_entropy=TRUE); 
$_SESSION['userid'] = $userid; 

$serendipity = 0.46599 + 0.00764 * $o + 0.02122 * $c + (-0.01317) * $e + 0.00464 * $a + (-0.00402) * $n;
$_SESSION['serendipity'] = $serendipity; 
print($_SESSION['serendipity']); 

$sql1 = "INSERT INTO utente_ser (user_id, gender, age_range,education, profession, perweek, genres, serendipity) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt2 = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt2, $sql1)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt2, "siiiiisd",
                        $userid,
                       $gender,
                       $age_range,
                       $education, 
                       $profession,
                       $perweek,
                       $genres, 
                       $serendipity);

mysqli_stmt_execute($stmt2);

header( 'Location: ratings.html' );
?> 