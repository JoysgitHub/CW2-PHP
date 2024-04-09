
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
if (isset($_SESSION['id'])) {
	


	//Check if any fields are empty and return error
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			header("Location: addstudent.php?error=Fields Cannot Be Left Empty");
			die();
		}
	}

	//if file is set check file type. if not jpg, jpeg then return error
	if (isset($_FILES['studentImage'])) {
		$image = $_FILES['studentImage']['tmp_name'];
		
		$imagedata = addslashes(file_get_contents($image));

		if (!exif_imagetype($image)) {
			
			header("Location: addstudent.php?error=Please Upload An Image File. Accepted Formats; jpg, png, jpeg");

			die();
		}
	}	
	//Clean all inputs 
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
	

	//Check if passwords match
	if ($password != $confirmPassword) {
		header("Location: addstudent.php?error=Password Confirmation Mismatch");
		die();
	}
		
	//password length policy
	if (strlen($password) <  8) {
		header("Location: addstudent.php?error=Password Must be over 8 characters");
		die();
	}

	//Enforce password policy	
	if (!complexityChecker($password)) {

		header("Location: addstudent.php?error= Password must contain at least one uppercase letter,a lowercase letter, a number, and a symbol");
		die();
	}

	$passHash = generatePasswordHash($password);

	//SQL statment
	/* $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentimage)  VALUES ('$id','$passHash','$dob' , '$name', '$lastname', '$street', '$town', '$county', '$country', '$postcode','$imagedata' );"; */

	/* $ret = mysqli_query($conn, $sql); */

	// Prepare the SQL statement with placeholders
	
	$sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	// Prepare the statement
	$stmt = mysqli_prepare($conn, $sql);

	// Binding cleaned variable data to the sql statment
	mysqli_stmt_bind_param($stmt, "ssssssssss", $id, $passHash, $dob, $name, $lastname, $street, $town, $county, $country, $postcode);

	
	//Return error to addstudent page
	if (!mysqli_stmt_execute($stmt)) {

		header("Location: addstudent.php?error= Unsuccessful Could Not Add Student");
		die();

	}

	
	mysqli_stmt_close($stmt);
	//Return successful message after completion to the addstudent.php page	
	
	$sql2 = "UPDATE student SET studentimage = '$imagedata' WHERE studentid='$id' ";
		
		
	$ret = mysqli_query($conn, $sql2);
		
	header("Location: addstudent.php?success=Successfully Added Student ");


	echo template("templates/default.php", $data);

} else {
	header("Location: index.php");
}
mysqli_close($conn);
echo template("templates/partials/footer.php");

?>
