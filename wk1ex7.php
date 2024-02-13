<html>
<body>
<?php
	//This scripts multiplies the hourlyrate by hoursperweek
	// and displays the result

	$hourlyrate = 5.75;
	$hoursperweek = 4;
	$gross = $hourlyrate * $hoursperweek;
	echo "Result: ", $gross;
?>
</body>
</html>
