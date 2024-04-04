<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If a module has been selected
   if (isset($_POST['selmodule'])) {
      $sql = "insert into studentmodules values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
	  $result = mysqli_query($conn, $sql);
	  /* $data['content'] .= "<body class=\"bg-gray-800\">"; */
		header("Location: modules.php ");
      /* $data['content'] .= "<p class=\" text-green-500\" >The module " . $_POST['selmodule'] . " has been assigned to you</p>"; */
	 /* $data['content'] .=  "</body>"; */
   }
   else  // If a module has not been selected
   {

     // Build sql statment that selects all the modules
     $sql = "select * from module";
     $result = mysqli_query($conn, $sql);
	 $data['content'] .= "<body class=\"bg-gray-800\">";
	 $data['content'] .= "<form name='frmassignmodule' action='' method='post'  class='max-w-md mx-auto mt-8 bg-white p-6 rounded-lg shadow-md'>";

     $data['content'] .= "<h2 class='text-2xl font-semibold mb-4 text-center'>Select a module to assign</h2><br/>";
     $data['content'] .= "<select name='selmodule' class='w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500'>";
     // Display the module name sin a drop down selection box
     while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
     }
     $data['content'] .= "</select><br/>";
     $data['content'] .= "<button class='bg-blue-500 mt-4 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded' type='submit' name='confirm' value='Save' >Save</button>";
     $data['content'] .= "</form>";
	 $data['content'] .=  "</body>";
   
   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
