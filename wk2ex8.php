<?php 

//Thhis script creates an array with 7 values and uses the for loops
// count variable to iterate through the indexes. 
	


$topModules[0] = "Internet Systems Development";
$topModules[1] = "Programming 1";
$topModules[2] = "Programming 2";
$topModules[3] = "OOAD";
$topModules[4] = "Software Engineering";
$topModules[5] = "Mobile applications";
$topModules[6] = "Web Developments";

for ($count = 0; $count < 7; $count++) {
	echo "$count module is $topModules[$count] <br/>";
}


?>
