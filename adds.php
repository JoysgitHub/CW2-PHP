
<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
include ("_includes/passwordLib.php");
//xxs safety
function cleanInput($input):string{
	$cleanOut = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
	return $cleanOut;

}


function generatePasswordHash($password): string{
	$hashedPass = password_hash($password, $algo=PASSWORD_DEFAULT);	
	return $hashedPass;
}


function echoPara($name, $value):void{
	
	echo "$name: $value<br>";
}



// check logged in
if (isset($_SESSION['id'])) {


	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			header("Location: addstudent.php?error=Fields Cannot Be Left Empty");
			die();
		}
	}



	$id = cleanInput($_POST['txtid']);
	$name = cleanInput($_POST['txtfirstname']);
	$lastname = cleanInput($_POST['txtlastname']);
	$dob = cleanInput($_POST['txtdate']);
	$street = cleanInput($_POST['txthouse']);
	$town = cleanInput($_POST['txttown']);
	$county = cleanInput($_POST['txtcounty']);
	$country = cleanInput($_POST['txtcountry']);
	$postcode = cleanInput($_POST['txtpostcode']);
	$password = cleanInput($_POST['txtpassword']);
	$confirmPassword = cleanInput($_POST['confirmpass']);
	


	if ($password != $confirmPassword) {
		header("Location: addstudent.php?error=Password Confirmation Mismatch");
		die();
	}
		
	//password length policy
	if (strlen($password) < 8) {
		header("Location: addstudent.php?error=Password Must be over 8 characters");
		die();
		}
	
	if (!complexityChecker($password)) {

		header("Location: addstudent.php?error= Password must contain at least a uppercase letter,a lowercase letter, a number, and a symbol");
		die();
	}else {
		echo "PASSWORD MEETS CRITERIA<br/>";
	}

	
	$passHash = generatePasswordHash($password);
	echoPara("HASH", $passHash);

	foreach ($_POST as $key => $value) {
		echo "$key: $value<br>";
	
	}


	$sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)  VALUES ('$id','$passHash','$dob' , '$name', '$lastname', '$street', '$town', '$county', '$country', '$postcode');";

	$ret = mysqli_query($conn, $sql);
	if (!$ret) {
		 // Query error
		$errorMessage = mysqli_error($conn);
		echo "Query failed: $errorMessage";
	}
	echo "SQL: $sql<br/>";
   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}
mysqli_close($conn);
echo template("templates/partials/footer.php");

?>
