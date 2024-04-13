
<?php 

// Connect to the server
$conn = mysqli_connect("localhost", "root", "" );

if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}


// Create the databse
$sql = "CREATE DATABASE test2;";
$result = mysqli_query($conn, $sql);


//Checks the return value of the result
if (!$result) {
	mysqli_close($conn);
	die("error result: ". mysqli_error($conn));
	exit(1);
}

echo "[+] DATABASE CREATED <br/>";

mysqli_close($conn);


//Connect to the new database and create the students table

$conn = mysqli_connect("localhost", "root", "" , "test2");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

$sql  = "CREATE TABLE `student` (
  `studentid` varchar(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `house` varchar(30) NOT NULL,
  `town` varchar(30) NOT NULL,
  `county` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postcode` varchar(10) NOT NULL
);";


$result = mysqli_query($conn, $sql);

//Checks the return value of the result
if (!$result) {
	mysqli_close($conn);
	die("error result: ". mysqli_error($conn));
	exit(1);
}


echo "[+]STUDENT TABLE CREATED<br/>";



//Create the module table

$sql = "CREATE TABLE `module` (
  `modulecode` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
);";



$result = mysqli_query($conn, $sql);

//Checks the return value of the result
if (!$result) {
	mysqli_close($conn);
	die("error result: ". mysqli_error($conn));
	exit(1);
}


echo "[+] MODULE TABLE CREATED<br/>";



//Create the students module table
$sql = "CREATE TABLE `studentmodules` (
  `studentid` varchar(8) NOT NULL,
  `modulecode` varchar(10) NOT NULL
);";



$result = mysqli_query($conn, $sql);

//Checks the return value of the result
if (!$result) {
	mysqli_close($conn);
	die("error result: ". mysqli_error($conn));
	exit(1);
}


echo "[+] STUDENT MODULE TABLE CREATED<br/>";

//Create the primary keys for each table

 $sql = "ALTER TABLE `module`
 ADD PRIMARY KEY (`modulecode`);";
$result = mysqli_query($conn, $sql);


 $sql = "ALTER TABLE `student`
 ADD PRIMARY KEY (`studentid`);";
$result = mysqli_query($conn, $sql);


 $sql = "ALTER TABLE `studentmodules`
 ADD PRIMARY KEY (`studentid`,`modulecode`);";
$result = mysqli_query($conn, $sql);

echo "[+] PRIMARY KEYS ADDED<br/>";

echo "-----------------------------------------<br/>";
echo "-------INSERTING DATA-------------------<br/>";
echo "-----------------------------------------<br/>";


//Insert module code, name and level into the module table
$sql = "INSERT INTO `module` (`modulecode`, `name`, `level`) VALUES
('CO106', 'Programming Development', 1),
('CO107', 'Programming Principles', 1),
('IN251', 'Internet Systems Development', 2);";

$result = mysqli_query($conn, $sql);

//Checks the return value of the result
if (!$result) {
	mysqli_close($conn);
	die("error result: ". mysqli_error($conn));
	exit(1);
}


echo "[+] MODEULES INSERTED <br/>";



mysqli_close($conn);

echo "<script> alert('DATABASE CREATED') </scrip>";

header("Location: seed.php");

?>
