
<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   if (isset($_SESSION['id'])) {
		
		//Check if student array is empty
	   if (empty($_POST['students'])) {
			

		   //If student array is empty return error,
		   header("Location: students.php?error=Please Select Students");
	   }else{

		   //For each loop to loop through each student id and delete 
		   //and delete student
		foreach ( $_POST['students'] as $key => $value) {
	
			echo "Student: [". ($key). "]$value <br>";
			$sql = "DELETE FROM student WHERE studentid='$value';";
			$ret = mysqli_query($conn, $sql);
			if (!$ret) {
				echo "Failed to delete students";
			}

		}
		//return success message with number of students deleted.
		$key+=1;
		header("Location: students.php?success=$key");
	   }

   } else {
      echo template("templates/login.php", $data);
   }

	mysqli_close($conn);
   echo template("templates/partials/footer.php");

?>
