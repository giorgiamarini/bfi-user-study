<?php
include('query.php');

$apiKey = "1cd3b200";

$index = ['rec1', 'rec2', 'rec3', 'rec4', 'rec5'];
$results = [];

for ($i = 0; $i < 5; $i++){
    $movie = $rows[$index[$i]]; 
    $python_output = exec("/Library/Frameworks/Python.framework/Versions/3.10/bin/python3 ./csv/movie_info.py $movie 2>&1");
    $my_array = json_decode($python_output, true);
    $movieTitle = $my_array['title'];
    $movieTitle = array_values($movieTitle);
    
    $imdb_id = array_values($my_array['imdb_id']); 
    $imbd_url = "https://www.imdb.com/title/tt0" .$imdb_id[0]."/"; 
    $result = [$movieTitle[0], $imbd_url];

    array_push($results, $result);
}

?>