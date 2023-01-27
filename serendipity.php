<!DOCTYPE HTML> <!-- which version of html we are using -->
<html>

	<head>
		<meta charset=“utf-8”>
		<meta name=“description” content=“Big Five Personality Inventory">
		<title>Big Five Personality Inventory</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">

	</head>

	<body background="Images/A1D29F00-389E-428E-8F23-FAE0EB974C4E.jpeg">	

		<div id="background"> <!-- this is the wrap for the whole page -->

			<div id="wrap">

				<header id="header">
						<h1>Big Five Personality Inventory</h1>
							<h2> Giorgia Marini, Universit&agrave; degli Studi Roma Tre</h2> 
				</header>

				<div id="content">
					<!-- Create a form for the test and add data attributes to each question -->
					<form id="ser-form" action = "process-ser.php" method = "post"><p>
                    <p><strong> Here are your recommendations (Serendipity Algorithm): </strong></p>
         <p>
            <?php 
                include('recommendations.php'); 
                print_r($results[0][0]);
            ?>
        </p>
            <a href="<?php echo $results[0][1]; ?>">IMDB page here! </a>
        <p></p>
         <p>
            <?php 
                include('recommendations.php'); 
                print_r($results[1][0]);
            ?>
        </p>
            <a href="<?php echo $results[1][1]; ?>">IMDB page here! </a>
        <p></p>
         <p>
            <?php 
                include('recommendations.php'); 
                print_r($results[2][0]);
            ?>
        </p>
            <a href="<?php echo $results[2][1]; ?>">IMDB page here! </a>
        <p></p>
        <p>
            <?php 
                include('recommendations.php'); 
                print_r($results[3][0]);
            ?>
        </p>
        <a href="<?php echo $results[3][1]; ?>">IMDB page here!</a>
        <p></p>
        <p>
            <?php 
                include('recommendations.php'); 
                print_r($results[4][0]);
            ?>
        </p>
        <a href="<?php echo $results[4][1]; ?>">IMDB page here!</a>
        <p></p>
        <p>
        <p>I was positively found by the suggestions received</p>
        <p><input type="radio" id="ser5q1" name="s1" value="5"><label for="ser5q1">strongly agree</label>
            <input type="radio" id="ser4q1" name="s1" value="4"><label for="ser4q1">agree</label>
            <input type="radio" id="ser3q1" name="s1" value="3" checked><label for="ser3q1">undecided</label>
            <input type="radio" id="ser2q1" name="s1" value="2"><label for="ser2q1">disagree</label>
            <input type="radio" id="ser1q1" name="s1" value="1"><label for="ser1q1">strongly disagree</label></p>

        <p>The suggestions received helped me discover something new that I probably would not have discovered otherwise</p>
        <p><input type="radio" id="ser5q2" name="s2" value="5"><label for="ser5q2">strongly agree</label>
            <input type="radio" id="ser4q2" name="s2" value="4"><label for="ser4q2">agree</label>
            <input type="radio" id="ser3q2" name="s2" value="3" checked><label for="ser3q2">undecided</label>
            <input type="radio" id="ser2q2" name="s2" value="2"><label for="ser2q2">disagree</label>
            <input type="radio" id="ser1q2" name="s2" value="1"><label for="ser1q2">strongly disagree</label></p> 

        <p>The suggested items are different from the ones I usually choose</p>
        <p><input type="radio" id="ser5q3" name="s3" value="5"><label for="ser5q3">strongly agree</label>
            <input type="radio" id="ser4q3" name="s3" value="4"><label for="ser4q3">agree</label>
            <input type="radio" id="ser3q3" name="s3" value="3" checked><label for="ser3q3">undecided</label>
            <input type="radio" id="ser2q3" name="s3" value="2"><label for="ser2q3">disagree</label>
            <input type="radio" id="ser1q3" name="s3" value="1"><label for="ser1q3">strongly disagree</label></p> 
        
        <p>I did not know the items that were suggested to me</p>
        <p><input type="radio" id="ser5q4" name="s4" value="5"><label for="ser5q4">strongly agree</label>
            <input type="radio" id="ser4q4" name="s4" value="4"><label for="ser4q4">agree</label>
            <input type="radio" id="ser3q4" name="s4" value="3" checked><label for="ser3q4">undecided</label>
            <input type="radio" id="ser2q4" name="s4" value="2"><label for="ser2q4">disagree</label>
            <input type="radio" id="ser1q4" name="s4" value="1"><label for="ser1q4">strongly disagree</label></p> 
                        
        <p>I think that if I choose them, I would appreciate the items that have been suggested to me</p>
        <p><input type="radio" id="ser5q5" name="s5" value="5"><label for="ser5q5">strongly agree</label>
            <input type="radio" id="ser4q5" name="s5" value="4"><label for="ser4q5">agree</label>
            <input type="radio" id="ser3q5" name="s5" value="3" checked><label for="ser3q5">undecided</label>
            <input type="radio" id="ser2q5" name="s5" value="2"><label for="ser2q5">disagree</label>
            <input type="radio" id="ser1q5" name="s5" value="1"><label for="ser1q5">strongly disagree</label></p> 
                            
        <p>I am satisfied with the suggestions received</p>
        <p><input type="radio" id="ser5q6" name="s6" value="5"><label for="ser5q6">strongly agree</label>
            <input type="radio" id="ser4q6" name="s6" value="4"><label for="ser4q6">agree</label>
            <input type="radio" id="ser3q6" name="s6" value="3" checked><label for="ser3q6">undecided</label>
            <input type="radio" id="ser2q6" name="s6" value="2"><label for="ser2q6">disagree</label>
            <input type="radio" id="ser1q6" name="s6" value="1"><label for="ser1q6">strongly disagree</label></p>
        </p>
<input type="submit" name="submit" value="Evaluate this algotithm!">
</form>

				
					</div>

				</div>


			</div>

		</div>

	</body>

<html>