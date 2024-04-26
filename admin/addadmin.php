<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

include ("_includes/passwordLib.php");

// Check if session id is set and if user is an admin
if (isset($_SESSION['id']) && isAdmin($_SESSION['id']) == true) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

	
	$hashedPass = password_hash($_POST['txtpassword'], $algo=PASSWORD_DEFAULT);	
  
	$sql = "INSERT INTO admin (id, username, password, firstname, lastname) VALUES (NULL,?,?,?,?)";


	// Prepare the statement
	$stmt = mysqli_prepare($conn, $sql);

	// Binding cleaned variable data to the sql statment

	mysqli_stmt_bind_param($stmt, 'ssss',$_POST['txtusername'], $hashedPass, $_POST['txtfirstname'], $_POST['txtlastname']);
	
	//Return error to addstudent page
	if (!mysqli_stmt_execute($stmt)) {

		header("Location: addadmin.php?error= Unsuccessful Could not add Admin");
		die();

	}

	
	mysqli_stmt_close($stmt);

	  /* $result = mysqli_query($conn,$sql); */
	header("Location: addadmin.php?success=Admin Added");
   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
 




	 echo "<body class=\"bg-gray-800\">";
    echo "<div class='container mx-auto p-8'>";
    echo "<h2 class='text-2xl text-white text-center mb-4'>New Admin</h2>";
    echo "<div class='flex justify-center'>";
    echo "</div>";
	echo "<br/>";
 
   }

	if (isset($_GET['success'])) {
		echo "<div  >";
		echo "<p class='block text-green-300 text-sm font-bold mb-2 text-xl  text-center'>$_GET[success] </p>";
		echo "</div>";
	}
   /* // render the template */
   /* echo template("templates/default.php", $data); */
echo "<form name='frmdetails' action='$_SERVER[PHP_SELF]' method='post' class='max-w-md mx-auto'>";




echo "<div class='mb-4'>";
    echo "<label for='txtusername' class='block text-gray-300 text-sm font-bold mb-2'> Username</label>";
    echo "<input name='txtusername' type='text' value='' required class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
	echo "</div>";



echo "<div class='mb-4'>";
    echo "<label for='txtpassword' class='block text-gray-300 text-sm font-bold mb-2'> Password</label>";
    echo "<input name='txtpassword' type='password' value='' required class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
	echo "</div>";


echo "<div class='mb-4'>";
    echo "<label for='txtfirstname' class='block text-gray-300 text-sm font-bold mb-2'>First Name:</label>";
    echo "<input name='txtfirstname' type='text' value=''  required class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
	echo "</div>";

    echo "<div class='mb-4'>";
    echo "<label for='txtlastname' class='block text-gray-300 text-sm font-bold mb-2'>Surname:</label>";
    echo "<input name='txtlastname' type='text' value='' required class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
	echo "</div>";

	echo "</div>";

    echo "<div class='text-center'>";
    echo "<button type='submit' value='Add' name='submit' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Save</button>";
    echo "</div>";
    echo "</form>";

		 echo "</body>";
} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
