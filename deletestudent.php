
<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   if (isset($_SESSION['id'])) {
		



	   if (empty($_POST['students'])) {

		   header("Location: students.php?error=Please Select Students");
	   }else{
		foreach ( $_POST['students'] as $key => $value) {
	
			echo "Student: [". ($key). "]$value <br>";
			$sql = "DELETE FROM student WHERE studentid='$value';";
			$ret = mysqli_query($conn, $sql);
			if (!$ret) {
				echo "Failed to delete students";
			}

		}
		$key+=1;
		header("Location: students.php?success=$key");
	   }

   } else {
      echo template("templates/login.php", $data);
   }

	mysqli_close($conn);
   echo template("templates/partials/footer.php");

   // another test edit
?>
