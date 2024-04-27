
<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id']) && isAdmin($_SESSION['id']) == false ) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to update the student details

	if (isset($_FILES['studentImage'])) {
		$image = $_FILES['studentImage']['tmp_name'];
		
		$imagedata = addslashes(file_get_contents($image));

		if (!exif_imagetype($image)) {
			
			header("Location: updateimage.php?error=Please Upload An Image File. Accepted Formats; jpg, png, jpeg");

			die();
		}
	}	


	$sql2 = "UPDATE student SET studentimage = '$imagedata' WHERE studentid='$_SESSION[id]' ";
		
		
	$ret = mysqli_query($conn, $sql2);
		
	  /* $result = mysqli_query($conn,$sql); */
	header("Location: updateimage.php?success=Image Updated Successfully");
   } else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
 



	   $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

    echo "<body class=\"bg-gray-800\">";
    echo "<div class='container mx-auto p-8'>";
	echo "<div class='flex justify-center'>";

	echo "<form name='frmdetails' enctype='multipart/form-data' action='$_SERVER[PHP_SELF]' method='post' class='max-w-md mx-auto bg-white shadow-md rounded-xl px-8 pt-6 pb-8 mb-4' onsubmit='return confirmSubmission()'>";
	echo "<div class='mb-4'>";
	echo "</div>";

    echo "<h2 class='text-2xl text-gray-900  text-center font-bold  mb-4'>My Image</h2>";
		if (!empty($row['studentimage'])) {
			// Encode the image data
			$base64Image = base64_encode($row['studentimage']);
			
			// Output the image tag with the encoded image data
			echo "<img src='data:image/jpeg;charset=utf8;base64,$base64Image' class='h-50 w-58 rounded-lg mx-auto' alt='Student Image'>";
		} else {
			// If studentimage is null or empty, output a placeholder image or handle it accordingly
			echo "<p class='text-center'>No image available</p>";
		}
	if (isset($_GET['success'])) {
		echo "<div  >";
		echo "<p class='block text-green-300 text-sm font-bold mb-2 text-xl  text-center'>$_GET[success] </p>";
		echo "</div>";
	}
	if (isset($_GET['error'])) {
		echo "<div  >";
		echo "<p class='block text-red-500 text-sm font-bold mb-2 text-xl  text-center'>$_GET[error] </p>";
		echo "</div>";
	}
	echo "<div class='mb-4'>";
	echo "<input class='border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' type='file' name='studentImage' id='studentImage' accept='image/jpeg, image/png, image/jpg' required>";
	echo "</div>";

	echo "<div class='flex items-center justify-center'>";
	echo "<button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline' type='submit' name='submit'>Save</button>";
	echo "</div>";

	echo "</form>";





echo "<script>";
echo "function confirmSubmission() {";
echo"     return confirm(\"Are you sure you want to submit?\");";
   echo "}";
echo "</script>";


	echo "</body>";
   }
} else {
	unset($_SESSION['id']);   
	header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
