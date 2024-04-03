<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
include ("_includes/passwordLib.php");
//xxs safety

// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

		$sql = "SELECT studentid FROM student ORDER BY studentid DESC LIMIT 1";
		$ret = mysqli_query($conn, $sql);

		$lastId = mysqli_fetch_assoc($ret);
		$lastId = $lastId['studentid'];
		$lastId = $lastId + 1;
  
		$data['content'] = <<<EOD


	   <h2>Add Student</h2>
	   <form name="frmdetails" action="adds.php" method="post">
	   ID:
	   <input name="txtid" type="text" value="$lastId" readonly  /><br/>
	   First Name :
	   <input name="txtfirstname" type="text" value="" required /><br/>
	   Surname :
	   <input name="txtlastname" type="text"  value="" required /><br/>
	   Date Of Birth:
	   <input name="txtdate" type="text"  value="" placeholder="YYYY-MM-DD" required /><br/>
	   Number and Street :
	   <input name="txthouse" type="text"  value="" required /><br/>
	   Town :
	   <input name="txttown" type="text"  value="" required /><br/>
	   County :
	   <input name="txtcounty" type="text"  value="" required /><br/>
	   

		Country :
	   <select name="txtcountry"  >
	   <option value="UK" > United Kingdom </option>
	   <option value="US" > United States </option>
	   <option value="IN" >India  </option>
	   <option value="ID" >Indonesia</option>
	   <option value="JP" > Japan  </option>
	   <option value="ET" > Ethiopia  </option>
	   <option value="PH" > Philippines </option>
	   <option value="TR" > Turkey </option>
	   <option value="DE" > Germany  </option>
	   <option value="FR" > France  </option>
	   <option value="IT" > Italy  </option>
	   <option value="PT" > Portugal  </option>
	   </select/><br/>

	   Postcode :
	   <input name="txtpostcode" type="text"  value="" reuired /><br/>
		Password:
	   <input name="txtpassword" type="password"  value="" /><br/>
		Confirm Password:
	   <input name="confirmpass" type="password"  value="" /><br/>
	   <input type="submit" value="Save" name="submit"/>
	   </form>

	EOD;

   /* } */


   // render the template
   echo template("templates/default.php", $data);
		
		
   if (isset($_GET['error'])) {
		echo "<p style='color: red;font-weight: bold; '> $_GET[error]</p>";
   }

   if (isset($_GET['success'])) {
			  
	   echo "<p style='color: green;font-weight: bold; '> $_GET[success] </p>";

	}
} else {
   header("Location: index.php");
}
mysqli_close($conn);
echo template("templates/partials/footer.php");

?>
