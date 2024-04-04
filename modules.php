<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student's modules
      $sql = "select * from studentmodules sm, module m where m.modulecode = sm.modulecode and sm.studentid = '" . $_SESSION['id'] ."';";

      $result = mysqli_query($conn,$sql);
	
      
 //--------------------------------------------------------------------------------- 
	  $data['content'] .= "<body class=\"bg-gray-800 text-white\">";
	// prepare page content
	$data['content'] .= "<div class='container mx-auto p-8'>";
	$data['content'] .= "<h1 class='text-2xl font-bold text-center mb-4'>Modules</h1>";
	$data['content'] .= "<div class='overflow-x-auto'>";
	$data['content'] .= "<table class='table-auto w-full border-collapse'>";
	$data['content'] .= "<thead>";
	$data['content'] .= "<tr class='bg-gray-700'>";
	$data['content'] .= "<th class='px-4 py-2 text-left text-white'>Code</th>";
	$data['content'] .= "<th class='px-4 py-2 text-left text-white'>Type</th>";
	$data['content'] .= "<th class='px-4 py-2 text-left text-white'>Level</th>";
	$data['content'] .= "</tr>";
	$data['content'] .= "</thead>";
	$data['content'] .= "<tbody class='bg-gray-900'>";
	// Display the modules within the html table
	while($row = mysqli_fetch_array($result)) {
		$data['content'] .= "<tr>";
		$data['content'] .= "<td class='border px-4 py-2'>$row[modulecode]</td>";
		$data['content'] .= "<td class='border px-4 py-2'>$row[name]</td>";
		$data['content'] .= "<td class='border px-4 py-2'>$row[level]</td>";
		$data['content'] .= "</tr>";
	}
	$data['content'] .= "</tbody>";
	$data['content'] .= "</table>";
	$data['content'] .= "</div>";
	$data['content'] .= "</div>";
	$data['content'] .= "</body>";
      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>
