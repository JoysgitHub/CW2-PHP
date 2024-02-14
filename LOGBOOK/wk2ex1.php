//Calculates the wage by multiping the hourlyrate
//by hoursperweek
<?php
	$hourlyrate = 5.75;
	$hoursperweek = 40;
	$gross = $hourlyrate * $hoursperweek;
?>


<html>
<head></head>
	<body>
	
		//Prints the result stored in variable gross
	
		<p> My Gross Wage Is: <?php print("$gross");?> </p>
	</body>
</html>
