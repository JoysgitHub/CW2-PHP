<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   echo template("templates/partials/header.php");

   if (isset($_GET['return'])) {
      $msg = "";
      if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
      $data['message'] = "<p>$msg</p>";
   }
   
	// Check if session id is set
	if (isset($_SESSION['id'])){

	//sql statment to check if user is an admin	
    $sql = "SELECT COUNT(*) AS count FROM admin WHERE username = '$_SESSION[id]'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	if($row['count'] > 0 ) {
	   $data['content'] = "<p class='text-xl'></p><br/>";
	  
	 
      echo template("templates/partials/nav.php");
	   echo template("templates/default.php", $data);
	   echo template("templates/partials/dashbody.php");
	}else {

		//if user is not an admin unset the session and redirect to login page.	
	   unset($_SESSION['id']);
      echo template("templates/login.php", $data);
	}
	   
	
	
	
	} else {
	   unset($_SESSION['id']);
      echo template("templates/login.php", $data);
   }

   echo template("templates/partials/footer.php");

   // another test edit
?>
