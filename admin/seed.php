<?php 

require_once 'vendor/autoload.php'; //Auto loads classes and files 
include("_includes/passwordLib.php"); //password hashing lib

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
include ("_includes/passwordLib.php");

if (isset($_SESSION['id'])) {
 

	echo template("templates/partials/header.php");
	echo template("templates/partials/nav.php");


$faker = Faker\Factory::create('en_US');

$SERVER = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "cw2_students";

// Connect to the server
$conn = mysqli_connect($SERVER, $USERNAME, $PASSWORD);

if (mysqli_connect_errno()) {
		echo "[-] ERROR: " . mysqli_connect_error();
		die();
	}

//query to check if database exists
$result = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$DB' ");


if (mysqli_num_rows($result) > 0) {
echo "<body class='bg-gray-600  text-white text-lg ' >";

	echo "[+] DATABASE $DB EXISTS.<br>";
}else {
	
	// Create the databse
	$sql = "CREATE DATABASE $DB;";
	$result = mysqli_query($conn, $sql);


	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("[-] ERROR: ". mysqli_error($conn));
	}

	echo "[+] DATABASE $DB CREATED <br/>";

	mysqli_close($conn);


	$conn = mysqli_connect($SERVER, $USERNAME, $PASSWORD , $DB);

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

$sql = "CREATE TABLE `admin` (
   id INT AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL

);";



	$result = mysqli_query($conn, $sql);

	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("ERROR: ". mysqli_error($conn));
		exit(1);
	}


	echo "[+]ADMIN TABLE CREATED<br/>";

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
	  `postcode` varchar(10) NOT NULL,
	  
	  `studentimage` LONGBLOB
	);";


	$result = mysqli_query($conn, $sql);

	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("ERROR: ". mysqli_error($conn));
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
		die("ERROR: ". mysqli_error($conn));
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
		die("ERROR: ". mysqli_error($conn));
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


$sql = "INSERT INTO `admin` (`id`,`username` ,`password`, `firstname`, `lastname`) VALUES
(NULL, 'admin','$2y$10$.LJBOl64nZWEVVE/v5mgNuzR01zx1zoyXuGJUa/zp2U.MQxkps3LS', 'Jon', 'Smith');";

	$result = mysqli_query($conn, $sql);

	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("ERROR: ". mysqli_error($conn));
		exit(1);
	}


	echo "[+] ADMIN INSERTED <br/>";

	//Insert module code, name and level into the module table
	$sql = "INSERT INTO `module` (`modulecode`, `name`, `level`) VALUES
	('CO106', 'Programming Development', 1),
	('CO107', 'Programming Principles', 1),
	('IN251', 'Internet Systems Development', 2);";

	$result = mysqli_query($conn, $sql);

	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("ERROR: ". mysqli_error($conn));
		exit(1);
	}


	echo "[+] MODEULES INSERTED <br/>";


	mysqli_close($conn);

}


$conn = mysqli_connect($SERVER, $USERNAME, $PASSWORD , $DB);

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
}


function echoPara($name, $value):void{
	
	echo "$name: $value<br>";
}


//Random password, uses the students firstName and the first part
//of their postcode to generate password and returns the hashed password.
function generatePasswordHash($name,$post): string{
	$trimPost = substr($post, 0, -4);
	$trimPost = trim($trimPost);
	$password = $name.$trimPost;
	echoPara("Password", $password);	
	$hashedPass = password_hash($password, $algo=PASSWORD_DEFAULT);	
	return $hashedPass;
}

//Random address
function randomAddress(): array{
	$faker = Faker\Factory::create('en_GB');

	$house = $faker->streetAddress;
	$town = $faker->city;
	$county = $faker->county;
	$country = "UK";
   	$postcode = $faker->postcode;

	return array($house, $town, $county, $country, $postcode);
}

//Random Date of birth 
function randomDOB(): string{
		
	$faker = Faker\Factory::create('en_US');

	$year = date('Y');
	$eighteen = $year - 18;
	$twentyFive = $year - 27;

	$minBirth = "$eighteen-01-01";
	$maxBirth = "$twentyFive-12-31";

	$DOB = $faker->dateTimeBetween( $maxBirth,$minBirth)->format('Y-m-d');
	return $DOB;
}

//--------------------MAIN------------------------------
//Checks if id exists, returns  the last id

echo "<body class='bg-gray-600  text-white text-lg ' >";

$sql = "SELECT studentid FROM student ORDER BY studentid DESC LIMIT 1";
$ret = mysqli_query($conn, $sql);


$rows =	mysqli_num_rows($ret);
/* echoPara("Num of Rows",$rows); */

if (mysqli_num_rows($ret) > 0) {
	$lastId = mysqli_fetch_assoc($ret);
	$lastId = $lastId['studentid'];
	echoPara("LAST ID", $lastId);
}else {
	$lastId = "19999999";
}
echo "------------------------------<br>";

//For loop to create 5 identities at a time
for ($i=0; $i < 5 ; $i++) { 

	$studentId = (int)$lastId + 1;
	echoPara("Student Id", $studentId);

	$firstName = $faker->firstName;
	$lastName = $faker->lastName;
	$DOB = randomDOB();
	echoPara("Name",$firstName );
	echoPara("Lastname",$lastName );
	echoPara("DOB ",$DOB);
	$address = randomAddress();	

	echoPara("House",$address[0]);
	echoPara("Town",$address[1]);
	echoPara("Couty",$address[2]);
	echoPara("Country",$address[3]);
	echoPara("Postcode",$address[4]);
	$hashedPass = generatePasswordHash($firstName, $address[4]);
	echoPara("Hashed Pass",$hashedPass);

	$randomNum = rand(1,4);
	$image = "C:/xampp/htdocs/CW2-PHP/img/student".$randomNum.".jpg";
	
		
	$imagedata = addslashes(file_get_contents($image));


	$sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentimage)  VALUES ('$studentId','$hashedPass','$DOB' , '$firstName', '$lastName', '$address[0]', '$address[1]', '$address[2]', '$address[3]', '$address[4]', '$imagedata');";
	/* echo "$sql<br>"; */
	echo "---------------------------<br>";
	$result = mysqli_query($conn, $sql);

	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("ERROR: ". mysqli_error($conn));
		exit(1);
	}
	$lastId++;
}	

echo "5 RECORDS ADDED SUCCESSFULLY";
mysqli_close($conn);


} else {
   header("Location: index.php");
}
echo template("templates/partials/footer.php");
?>
