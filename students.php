
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
		   $data['content'] .= "<body class='bg-gray-600 ' >";
	      $data['content'] .= "<form  onsubmit='return confirmSubmition()'  method='post' action='deletestudent.php'>";

		   // prepare page content
		  $data['content'] .= "<table class=' border border-black divide-y divide-black' bg-gray-900 border='1'>";
		  $data['content'] .= "<tr><th class='text-white bg-gray-900 text-white text-2xl' colspan='12' align='center'>Student Details</th></tr>";
		  $data['content'] .= "<tr><th class='text-white bg-gray-800 border border-black'>studentID</th>";
			$data['content'] .="<th class='text-white bg-gray-800 border border-black'>Name</th><th class='text-white bg-gray-800 border border-black' >Lastname</th>";

			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>DOB</th>";
			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>Street</th>";
			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>Town</th>";
			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>County</th>";
			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>Country</th>";
			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>Postcode</th>";
			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>Hash</th>";
			$data['content'] .= "<th class='text-white bg-gray-800 border border-black'>Studentimage</th></tr>";
		  // Display the student details with the columns
		  while($row = mysqli_fetch_array($result)) {
			 $data['content'] .= "<tr><td class='px-4 py-2 text-white border border-black'> $row[studentid] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[firstname] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[lastname] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[dob] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[house] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[town] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[county] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[country] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[postcode] </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'> $row[password] </td>";
			 $data['content'] .= " <td class='px-4 py-2 text-white border border-black'><img src='studentimage.php?id=$row[studentid]' height='100' width='100'  </td>";
			 $data['content'] .= "<td class='px-4 py-2 text-white border border-black'><input type='checkbox' name='students[]' value='$row[studentid]'/> </td></tr>";
		  }
		  $data['content'] .= "</table>";
		  $data['content'] .= "<div class='mx-auto'>";

		  //Create delete button and submit student id array.
		  /* $data['content'] .= "<button type='submit' class=\"deleteButton\" name='deleteButton' value='Delete'/>Delete</button>"; */
		  $data['content'] .= "<button type='submit' class='  bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-8 '>Delete</button>";
		  $data['content'] .= "</div>";
		  $data['content'] .= "</form>";
		  // render the template
		  echo template("templates/default.php", $data);
			
		  //Check if error display returned error information.		  
		  if (isset($_GET['error'])) {
				echo "<p style='color: red;font-weight: bold; '> $_GET[error]</p>";
		   }

		  //Display returned deleted number of students in the success array.
		echo "<div class='mx-auto' > ";
		  if (isset($_GET['success'])) {
			  if ($_GET['success'] == 1) {
			  
				  echo "<p style='color: green;font-weight: bold; '> Successfully Deleted $_GET[success] Student</p>";
			  }else {
				
				  echo "<p style='color: green; font-weight: bold;'> Successfully Deleted $_GET[success] Students</p>";
			  }
		  }
		echo "</div>";
		   $data['content'] .= "</body>";
   }else{
	   header("Location: index.php");

      /* echo template("templates/login.php", $data); */
	}
   echo template("templates/partials/footer.php");

?>
