<?php
	// This script demonstrates php support for non integer
	// values as indexes. For example on line 10, using the index "year 3" 
	// to print the value at  index "year 3".
	
	$mymarks["year 1"] = 55;
	$mymarks["year 2"] = 65;
	$mymarks["year 3"] = 75;
	
	foreach($mymarks as $index => $value){
		echo "for $index my grade was $value <br/>";
	}

	echo "<br/> My best year was Year 3 when i averaged ". $mymarks["year 3"]
?>

//This code uses a html table to display the string index and the value.
//it does this by iterating through the array using a for each loop.

<html>
<head>
<title>Data in table</title>
</head>
<body>
<table border=1 align="center">
<tr><th>Index</th><th>Mark</th></tr>
<?php 
	
	foreach($mymarks as $index => $value){
		echo "<tr><td>$index</td><td>$value %</td></tr>";
	}


?>
</table>
</body>
</html>
