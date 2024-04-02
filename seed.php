<?php 

require_once 'vendor/autoload.php'; //Auto loads classes and files 
include("_includes/dbconnect.inc"); //Db initialisation and error check
include("_includes/passwordLib.php"); //password hashing lib

$faker = Faker\Factory::create('en_US');

function echoPara($name, $value):void{
	
	echo "$name: $value<br>";
}


//Random password, uses the students firstName and the first part
//of their postcode to generate password and returns the hashed password.
function generatePasswordHash($name,$post): string{
	$trimPost = substr($post, 0, -4);
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
$sql = "SELECT studentid FROM student ORDER BY studentid DESC LIMIT 1";
$ret = mysqli_query($conn, $sql);


$rows =	mysqli_num_rows($ret);
echoPara("Num of Rows",$rows);

if (mysqli_num_rows($ret) > 0) {
	$lastId = mysqli_fetch_assoc($ret);
	$lastId = $lastId['studentid'];
	echoPara("LAST ID", $lastId);
}else {
	$lastId = "20000000";
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

	$sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)  VALUES ('$studentId','$hashedPass','$DOB' , '$firstName', '$lastName', '$address[0]', '$address[1]', '$address[2]', '$address[3]', '$address[4]');";
	echo "$sql<br>";
	echo "---------------------------<br>";
	$result = mysqli_query($conn, $sql);

	//Checks the return value of the result
	if (!$result) {
		mysqli_close($conn);
		die("error result: ". mysqli_error($conn));
		exit(1);
	}
	$lastId++;
}	

echo "5 RECORDS ADDED SUCCESSFULLY";
mysqli_close($conn);


?>
