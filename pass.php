
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

//generate password hash
function generatePasswordHash($password): string{
	$hashedPass = password_hash($password, $algo=PASSWORD_DEFAULT);	
	return $hashedPass;
}



// check logged in
/* if (isset($_SESSION['id']) { */
	
if (isset($_SESSION['id']) && isAdmin($_SESSION['id']) == false) {


	//Check if any fields are empty and return error
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			header("Location: passwordchange.php?error=Fields Cannot Be Left Empty");
			die();
		}
	}

	//if file is set check file type. if not jpg, jpeg then return error
	//Clean all inputs
	
		
	$id = cleanInput($_POST['txtid']);

	//Sql query to retrieve password hash
	$sql = "SELECT * FROM student WHERE studentid='$id';";
	$result = mysqli_query($conn, $sql);
	$details = mysqli_fetch_assoc($result);
	$currentPassHash = $details['password'];
	
	$oldpassword = cleanInput($_POST['txtcurrpass']);
	

	if (! password_verify($oldpassword,$currentPassHash)  ) {
		header("Location: passwordchange.php?error= Current password does not match ");
		die();
	}

	$password = cleanInput($_POST['txtpassword']);
	$confirmPassword = cleanInput($_POST['confirmpass']);
	

	//Check if passwords match
	if ($password != $confirmPassword) {
		header("Location: passwordchange.php?error=Password Confirmation Mismatch");
		die();
	}
		
	//password length policy
	if (strlen($password) <  8) {
		header("Location: passwordchange.php?error=Password Must be over 8 characters");
		die();
	}

	//Enforce password policy	
	if (!complexityChecker($password)) {

		header("Location: passwordchange.php?error= Password must contain at least one uppercase letter,a lowercase letter, a number, and a symbol");
		die();
	}

	$passHash = generatePasswordHash($password);

	//SQL statment
	/* $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentimage)  VALUES ('$id','$passHash','$dob' , '$name', '$lastname', '$street', '$town', '$county', '$country', '$postcode','$imagedata' );"; */

	/* $ret = mysqli_query($conn, $sql); */

	// Prepare the SQL statement with placeholders
	
	$sql = "UPDATE student SET password = ? WHERE studentid = ?";

	// Prepare the statement
	$stmt = mysqli_prepare($conn, $sql);

	// Binding cleaned variable data to the sql statment
	mysqli_stmt_bind_param($stmt, "ss",$passHash, $id);

	
	//Return error to passwordchange page
	if (!mysqli_stmt_execute($stmt)) {

		header("Location: passwordchange.php?error= Unsuccessful Could Change Password");
		die();

	}

	
	mysqli_stmt_close($stmt);
	//Return successful message after completion to the passwordchange.php page	
	
	header("Location: passwordchange.php?success=Successfully Changed Password ");


	echo template("templates/default.php", $data);

} else {
	header("Location: index.php");
}
mysqli_close($conn);
echo template("templates/partials/footer.php");

?>
