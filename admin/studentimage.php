<?php 
	//content type
	header("Content-type: image/jpg, image/jpeg");

	include ("_includes/dbconnect.inc");
	
	//sql query with the id supplied to get the image of the student image
	$sql = "SELECT studentimage FROM student WHERE studentid='$_GET[id]';";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_array($result);

	$image = $row["studentimage"];

	//Return the image	
	echo $image;
	mysqli_close($conn);
?>
