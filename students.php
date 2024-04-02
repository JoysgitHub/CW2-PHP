
<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in

   if (isset($_SESSION['id'])) {

		  echo template("templates/partials/header.php");

           // Build SQL statment that selects all students and their details
		   $sql = "select * from student";
		   //Execute query and return results	
		   $result = mysqli_query($conn,$sql);
	   

			//Build form arount the table
	      $data['content'] .= "<form  onsubmit='return confirmSubmition()'  method='post' action='deletestudent.php'>";

		  // prepare page content
		  $data['content'] .= "<table class='mainTable' border='1'>";
		  $data['content'] .= "<tr><th colspan='11' align='center'>Student Details</th></tr>";
		  $data['content'] .= "<tr><th>studentID</th><th>Name</th><th>Lastname</th><th>DOB</th><th>Street</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Hash</th></tr>";
		  // Display the student details with the columns
		  while($row = mysqli_fetch_array($result)) {
			 $data['content'] .= "<tr><td> $row[studentid] </td>";
			 $data['content'] .= "<td> $row[firstname] </td>";
			 $data['content'] .= "<td> $row[lastname] </td>";
			 $data['content'] .= "<td> $row[dob] </td>";
			 $data['content'] .= "<td> $row[house] </td>";
			 $data['content'] .= "<td> $row[town] </td>";
			 $data['content'] .= "<td> $row[county] </td>";
			 $data['content'] .= "<td> $row[country] </td>";
			 $data['content'] .= "<td> $row[postcode] </td>";
			 $data['content'] .= " <td> $row[password] </td>";
			 $data['content'] .= "<td><input type='checkbox' name='students[]' value='$row[studentid]'/> </td></tr>";
		  }
		  $data['content'] .= "</table>";


		  //Create delete button and submit student id array.
		  $data['content'] .= "<input type='submit' class=\"deleteButton\" name='deleteButton' value='Delete'/>";
		  $data['content'] .= "</form>";
		  // render the template
		  echo template("templates/default.php", $data);
			
		  //Check if error display returned error information.		  
		  if (isset($_GET['error'])) {
				echo "<p style='color: red;font-weight: bold; '> $_GET[error]</p>";
		   }

		  //Display returned deleted number of students in the success array.
		  if (isset($_GET['success'])) {
			  if ($_GET['success'] == 1) {
			  
				  echo "<p style='color: green;font-weight: bold; '> Successfully Deleted $_GET[success] Student</p>";
			  }else {
				
				  echo "<p style='color: green; font-weight: bold;'> Successfully Deleted $_GET[success] Students</p>";
			  }
		  }

	}else{

      echo template("templates/login.php", $data);
	}
   echo template("templates/partials/footer.php");

?>
