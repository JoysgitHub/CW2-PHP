<?php 

//This script uses a foreach loop to print the values in
//the array. It uses the $index variable to store the key 
//and the $value variable to store the value.

$topModules[0] = "Internet Systems Development";
$topModules[5] = "Programming 1";
$topModules[10] = "Programming 2";
$topModules[30] = "OOAD";
$topModules[40] = "Software Engineering";

foreach ($topModules as $index => $value) {
	echo "Index is $index and $value <br/>";
}

?>
