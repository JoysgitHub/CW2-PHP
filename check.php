
<?php 

$DB = "test2";

// Connect to the server
$conn = mysqli_connect("localhost", "root", "");

if (mysqli_connect_errno()) {
		echo "[-] ERROR: " . mysqli_connect_error();
		die();
	}

//query to check if database exists
$result = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$DB' ");


if (mysqli_num_rows($result) > 0) {
	echo "[+] DATABASE $DB EXISTS.<br>";
}else {
	
	// Create the databse
	$sql = "CREATE DATABASE test2;";
	$result = mysqli_query($conn, $sql);


	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("[-] ERROR: ". mysqli_error($conn));
	}

	echo "[+] DATABASE $DB CREATED <br/>";

}

mysqli_close($conn);
