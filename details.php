<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to update the student details
      $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
	header("Location: details.php?success=Your details have been updated");
   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

	 echo "<body class=\"bg-gray-800\">";
    echo "<div class='container mx-auto p-8'>";
    echo "<h2 class='text-2xl text-white text-center mb-4'>My Details</h2>";
    echo "<div class='flex justify-center'>";
    echo "<img src='studentimage.php?id=$_SESSION[id]' class='h-40  w-48  rounded-lg ' alt='Student Image'><br/>";
    echo "</div>";
	echo "<br/>";
 
   }

   /* // render the template */
   /* echo template("templates/default.php", $data); */
echo "<form name='frmdetails' action='$_SERVER[PHP_SELF]' method='post' class='max-w-md mx-auto'>";
    echo "<div class='mb-4'>";
    echo "<label for='txtfirstname' class='block text-gray-300 text-sm font-bold mb-2'>First Name:</label>";
    echo "<input name='txtfirstname' type='text' value='$row[firstname]' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
    echo "</div>";
    echo "<div class='mb-4'>";
    echo "<label for='txtlastname' class='block text-gray-300 text-sm font-bold mb-2'>Surname:</label>";
    echo "<input name='txtlastname' type='text' value='$row[lastname]' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
    echo "</div>";
    echo "<div class='mb-4'>";
    echo "<label for='txthouse' class='block text-gray-300 text-sm font-bold mb-2'>Number and Street:</label>";
    echo "<input name='txthouse' type='text' value='$row[house]' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
    echo "</div>";
    echo "<div class='mb-4'>";
    echo "<label for='txttown' class='block text-gray-300 text-sm font-bold mb-2'>Town:</label>";
    echo "<input name='txttown' type='text' value='$row[town]' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
    echo "</div>";
    echo "<div class='mb-4'>";
    echo "<label for='txtcounty' class='block text-gray-300 text-sm font-bold mb-2'>County:</label>";
    echo "<input name='txtcounty' type='text' value='$row[county]' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
    echo "</div>";
    echo "<div class='mb-4'>";
    echo "<label for='txtcountry' class='block text-gray-300 text-sm font-bold mb-2'>Country:</label>";
    echo "<input name='txtcountry' type='text' value='$row[country]' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
    echo "</div>";
    echo "<div class='mb-4'>";
    echo "<label for='txtpostcode' class='block text-gray-300 text-sm font-bold mb-2'>Postcode:</label>";
    echo "<input name='txtpostcode' type='text' value='$row[postcode]' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
	echo "</div>";
	echo "</div>";
	if (isset($_GET['success'])) {
		echo "<div  >";
		echo "<p class='block text-green-300 text-sm font-bold mb-2 text-xl  text-center'>$_GET[success] </p>";
		echo "</div>";
	}

    echo "<div class='text-center'>";
    echo "<button type='submit' value='Save' name='submit' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Save</button>";
    echo "</div>";
    echo "</form>";

		 echo "</body>";
} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
