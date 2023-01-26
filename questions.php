<?php 

$o = 12 + filter_input(INPUT_POST, "q5", FILTER_VALIDATE_INT) +
                filter_input(INPUT_POST, "q10", FILTER_VALIDATE_INT) +
                filter_input(INPUT_POST, "q15", FILTER_VALIDATE_INT) +
                filter_input(INPUT_POST, "q20", FILTER_VALIDATE_INT) + 
                filter_input(INPUT_POST, "q25", FILTER_VALIDATE_INT) + 
                filter_input(INPUT_POST, "q30", FILTER_VALIDATE_INT) - 
                filter_input(INPUT_POST, "q35", FILTER_VALIDATE_INT) + 
                filter_input(INPUT_POST, "q40", FILTER_VALIDATE_INT) +
                filter_input(INPUT_POST, "q41", FILTER_VALIDATE_INT) - 
                filter_input(INPUT_POST, "q44", FILTER_VALIDATE_INT); 


$c = 14 + filter_input(INPUT_POST, "q3", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q8", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q13", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q18", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q23", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q28", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q33", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q38", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q43", FILTER_VALIDATE_INT);

$e = 18 + filter_input(INPUT_POST, "q1", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q6", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q11", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q16", FILTER_VALIDATE_INT) - 
            filter_input(INPUT_POST, "q21", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q26", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q31", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q36", FILTER_VALIDATE_INT);

$a = 24 - filter_input(INPUT_POST, "q2", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q7", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q12", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q17", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q22", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q27", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q32", FILTER_VALIDATE_INT) - 
            filter_input(INPUT_POST, "q37", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q42", FILTER_VALIDATE_INT); 

$n = 18 + filter_input(INPUT_POST, "q4", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q9", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q14", FILTER_VALIDATE_INT) + 
            filter_input(INPUT_POST, "q19", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q24", FILTER_VALIDATE_INT) +
            filter_input(INPUT_POST, "q29", FILTER_VALIDATE_INT) -
            filter_input(INPUT_POST, "q34", FILTER_VALIDATE_INT) + 
            filter_input(INPUT_POST, "q39", FILTER_VALIDATE_INT);

$o = $o / 10; 
$c = $c / 9; 
$e = $e / 8; 
$a = $a / 9; 
$n = $n / 8; 
?>