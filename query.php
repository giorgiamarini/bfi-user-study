<?php
    session_start();
    include('connection.php');
    $sql = "SELECT * FROM rec WHERE user_id = '".$_SESSION['userid']."'";            
    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_assoc($result);

    print($rows['rec2']);

    function getId($url) {
        $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
        preg_match($regExp, $url, $match);

        return isset($match[2]) && strlen($match[2]) === 11 ? $match[2] : null;
    }

    function getIFrameMarkup($url){
        $videoId = getId($url);
        return '<iframe width="560" height="315" src="//www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
    }

    function get_movie_info($id){
        $sql = "SELECT * FROM cleaned_movies WHERE movie_id = '".$id."'";    
        $result = mysqli_query($conn, $sql);

        $rows = mysqli_fetch_assoc($result);     
        return $rows;

    }
    
?>