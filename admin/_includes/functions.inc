<?php

include "passwordLib.php";

/**
 * Validate Login function
 *
 * @param $id        - user ID
 * @param $password  - plaintext password
 * @return boolean   - returns true or false depending on successful authentication of user.
 */
function validatelogin($id,$password) {
   global $conn;
   // Build an SQL statment that will return a record with a matching id
   $sql = "select * from admin where username='$id';";

	echo "STATMENT: $sql";

	//echo $sql;
   $loginresult = mysqli_query($conn, $sql);
   $studentdetails = mysqli_fetch_assoc($loginresult);
	//print_r($studentdetails);

	// use PHP's verify_password function to check whether the stored
	// hash matches the given password
	if (password_verify($password, $studentdetails['password'])) {
		$_SESSION['id'] = $id;
		return true;
	}
	else {
		$_SESSION['id'] = '';
		return false;
	}
}


/**
 * Simple Templating function
 *
 * @param $file   - Path to the PHP file that acts as a template.
 * @param $args   - (optional) Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 *
 * Source: http://www.daggerhart.com/create-simple-php-templating-function/
 */
function template( $file, $args=array() ){
   // ensure the file exists
   if ( !file_exists( $file ) ) {
      return '';
   }

   // Make values in the associative array easier to access by extracting them
   if ( is_array( $args ) ){
      extract( $args );
   }

   // buffer the output (including the file is "output")
   ob_start();
   include $file;
   return ob_get_clean();
}

/**
 * Password Complexity checker
 *
 * @param $args   - String password value
 * @return bool	  - Outputs true if password meets complexity criteria or false if fails.
 *
 * 
 */
function complexityChecker($password):bool{

	//Unique character arrays for each type
	$upperLetters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
	$lowerLetters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	$numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$symbols = array(
    '!', '@', '#', '%', '^', '&', '*', '(', ')',
    '-', '_', '=', '+', '[', ']', '{', '}', '|', '\\',
    ';', ':', '"', '\'', ',', '.', '<', '>', '/', '?');
	//Boolean variable flags
	$uLetters = false;
	$lLetters = false;
	$num = false;
	$symb = false;
	
	//Check if a tleast one character exists
	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $upperLetters)) {
			$uLetters = true;
		}
	}
	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $lowerLetters)) {
			$lLetters = true;
		}
	}
	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $numbers)) {
			$num= true;
		}
	}
	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $symbols)) {
			$symb= true;
		}
	}
	
	//return true if all four flags are set, else false
	if ($uLetters && $lLetters && $num && $symb) {
		 
		return true;
	}else {
		return false;
	}

}


/**
 * Admin checker
 *
 * @param $args   -  Session ID
 * @return bool	  - Outputs true if user admin
 *
 * 
 */
function isAdmin($sessionID):bool{

	global $conn;

    $sql = "SELECT COUNT(*) AS count FROM admin WHERE username = '$sessionID'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	if($row['count'] > 0 ) {
		return true;
	}else {
		return false;
	}

}



?>
