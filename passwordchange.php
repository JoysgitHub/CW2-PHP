
<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
include ("_includes/passwordLib.php");
//xxs safety

// check logged in
/* if (isset($_SESSION['id'])) { */

if (isset($_SESSION['id']) && isAdmin($_SESSION['id']) == false) {
   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");


		echo "<div class='dark:bg-gray-800 h-screen overflow-hidden flex items-center justify-center'>";
		echo "<div class='bg-white lg:w-4/12 md:4/12 w-12/12 shadow-3xl  rounded-xl  '>"; 
		
		echo "	<img src='/CW2-PHP/img/logo_uni.png' class='w-25  h-25 mx-auto rounded-t-xl mt-4' alt='Image'>";
		echo "<div class='text-xl ml-5'>";
		echo "<h2 class='text-3xl font-bold text-center'>Change Password</h2>";

		 if (isset($_GET['error'])) {
			echo "<p class=' text-xl text-center' style='color: red;font-weight: bold; '> $_GET[error]</p>";
		}

		if (isset($_GET['success'])) {
			  
			echo "<p class=' text-xl text-center' style='color: green;font-weight: bold; '> $_GET[success] </p>";

		}



		echo "<form name='frmdetails' enctype='multipart/form-data' action='pass.php' method='post'>";
		echo "<br>";
		echo "ID ";
		echo "<input class='border border-gray-400'   name='txtid' type='text' value='$_SESSION[id]' readonly /><br/>";
		echo "Current Password";
		echo "<input class='border border-gray-400' name='txtcurrpass' type='password' value='' required /><br/>";
		echo "New Password ";
		echo "<input class='border border-gray-400' name='txtpassword' type='password' value='' /><br/>";
		echo "Confirm Password ";
		echo "<input class='border border-gray-400' name='confirmpass' type='password' value='' /><br/>";
		echo "<button class='px-10 font-bold text-22l py-3  mt-4 text-white bg-blue-900 rounded-lg hover:bg-blue-600' type='submit' value='Save' name='submit'>Change</button>";
		echo "</form>";
		echo "	</div>	";

		
		echo "</div>";
		echo "</div>";

   // render the template
   echo template("templates/default.php", $data);
		
} else {
   header("Location: index.php");
}
mysqli_close($conn);
echo template("templates/partials/footer.php");

?>
