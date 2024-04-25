
<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   if (isset($_SESSION['id'])) {
		
		//Check if student array is empty
	   if (empty($_POST['admins'])) {
			

		   //If student array is empty return error,
		   header("Location: admins.php?error=Please Select admins");
	   }else{

		   //For each loop to loop through each student id and delete 
		   //and delete student
		foreach ( $_POST['admins'] as $key => $value) {
	
			echo "Admin: [". ($key). "]$value <br>";
			$sql = "DELETE FROM  admin WHERE id='$value';";
			$ret = mysqli_query($conn, $sql);
			if (!$ret) {
				echo "Failed to delete admins";
			}

		}
		//return success message with number of students deleted.
		$key+=1;
		header("Location: admins.php?success=$key");
	   }

   } else {
      echo template("templates/login.php", $data);
   }

	mysqli_close($conn);
   echo template("templates/partials/footer.php");

?>
