<?php 
//This script creates an array of modules with the 
//module cose as the index and the marks as the value
//and then uses a for each loop to print the array.
//In each iteration it adds the value to the total 
//and at the end divides it by the amount of courses
//to work out the average and displays it.

$average = 0;
$total = 0;


$mymarks["CO453"] = 50;
$mymarks["CO450"] = 55;
$mymarks["CO404"] = 70;
$mymarks["CO558"] = 48;
$mymarks["CO556"] = 60;
$mymarks["CO557"] = 66;

foreach ($mymarks as $index => $value) {
	$total = $total  + $mymarks[$index];
	echo "Module: $index, Mark: $value % <br/>" ;
}

$average = $total / 6;

echo "The average is $average";



?>
