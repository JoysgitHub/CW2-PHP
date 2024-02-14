<html>
<body>
<?php
	//This scripts multiplies the hourlyrate by hoursperweek
	// and displays the result
	
	$netwage = 0;
	$hourlyrate = 5.75;
	$hoursperweek = 40;
	$gross = $hourlyrate * $hoursperweek;
	echo "Result: £", $gross;

	//The lines below calculate total deductable tax and minus it from
	//the gross income to calculate the final netwage.

	$totaltaxdeduction = 0.22 * $gross;
	$netwage = $gross - $totaltaxdeduction;
	echo "<br/>Tax-Deducted: £$totaltaxdeduction <br/>Net-Income: £$netwage";
?>
</body>
</html>
