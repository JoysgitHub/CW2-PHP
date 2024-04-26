<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
include ("_includes/passwordLib.php");
//xxs safety

// check logged in
/* if (isset($_SESSION['id'])) { */

if (isset($_SESSION['id']) && isAdmin($_SESSION['id']) == true) {
   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

		$sql = "SELECT studentid FROM student ORDER BY studentid DESC LIMIT 1";
		$ret = mysqli_query($conn, $sql);

		$lastId = mysqli_fetch_assoc($ret);
		$lastId = $lastId['studentid'];
		$lastId = $lastId + 1;
		echo "<div class='dark:bg-gray-800 h-screen overflow-hidden flex items-center justify-center'>";
		echo "<div class='bg-white lg:w-4/12 md:4/12 w-12/12 shadow-3xl  h-full '>"; 
		
		echo "	<img src='/CW2-PHP/img/logo_uni.png' class='w-25  h-25 mx-auto rounded-t-xl mt-4' alt='Image'>";
/* class='w-full px-4 py-2 mt-2 border border border-gray-400 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600' */
		/* echo "<div class='center'>"; */
		echo "<div class='text-xl ml-5'>";
		echo "<h2 class='text-3xl font-bold text-center'>Add Student</h2>";

		 if (isset($_GET['error'])) {
			echo "<p class=' text-xl text-center' style='color: red;font-weight: bold; '> $_GET[error]</p>";
		}

		if (isset($_GET['success'])) {
			  
			echo "<p class=' text-xl text-center' style='color: green;font-weight: bold; '> $_GET[success] </p>";

		}



		echo "<form name='frmdetails' enctype='multipart/form-data' action='adds.php' method='post'>";
		echo "ID ";
		echo "<input class='border border-gray-400'   name='txtid' type='text' value='$lastId' readonly /><br/>";
		echo "First Name ";
		echo "<input class='border border-gray-400' name='txtfirstname' type='text' value='' required /><br/>";
		echo "Surname ";
		echo "<input class='border border-gray-400' name='txtlastname' type='text' value='' required /><br/>";
		echo "Date Of Birth ";
		echo "<input class='border border-gray-400' name='txtdate' type='text' value='' placeholder='YYYY-MM-DD' required /><br/>";
		echo "Number and Street ";
		echo "<input class='border border-gray-400' name='txthouse' type='text' value='' required /><br/>";
		echo "Town ";
		echo "<input class='border border-gray-400' name='txttown' type='text' value='' required /><br/>";
		echo "County ";
		echo "<input class='border border-gray-400' name='txtcounty' type='text' value='' required /><br/>";
		echo "Country ";
		echo "<select name='txtcountry'>";
		echo "<option value='UK'>United Kingdom</option>";
		echo "<option value='US'>United States</option>";
		echo "<option value='IN'>India</option>";
		echo "<option value='ID'>Indonesia</option>";
		echo "<option value='JP'>Japan</option>";
		echo "<option value='ET'>Ethiopia</option>";
		echo "<option value='PH'>Philippines</option>";
		echo "<option value='TR'>Turkey</option>";
		echo "<option value='DE'>Germany</option>";
		echo "<option value='FR'>France</option>";
		echo "<option value='IT'>Italy</option>";
		echo "<option value='PT'>Portugal</option>";
		echo "</select><br/>";

		echo "Postcode ";
		echo "<input class='border border-gray-400' name='txtpostcode' type='text' value='' required /><br/>";
		echo "Password ";
		echo "<input class='border border-gray-400' name='txtpassword' type='password' value='' /><br/>";
		echo "Confirm Password ";
		echo "<input class='border border-gray-400' name='confirmpass' type='password' value='' /><br/>";
		echo "<input class='border border-gray-400' type='file' name='studentImage' accept='image/jpeg, image/png, image/jpg' required><br/>";
		echo "<button class='px-10 font-bold text-22l py-3  mt-4 text-white bg-blue-900 rounded-lg hover:bg-blue-600' type='submit' value='Save' name='submit'>Save</button>";
		echo "</form>";
		echo "	</div>	";
   /* if (isset($_GET['error'])) { */
		/* echo "<p class='ml-6 text-xl' style='color: red;font-weight: bold; '> $_GET[error]</p>"; */
   /* } */

   /* if (isset($_GET['success'])) { */
			  
	   /* echo "<p class='ml-6 text-xl' style='color: green;font-weight: bold; '> $_GET[success] </p>"; */

	/* } */

		
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
