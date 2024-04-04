
<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");
	$id = $_GET['id'];
   // if the form has been submitted
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $id . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
	  
	  echo "<h2>Student Details </h2><br/>";
	  $data['content'] = <<<EOD

   <form name="frmdetails" action="" method="post">
   First Name :
   <input name="txtfirstname" type="text" value="{$row['firstname']}" /><br/>
   Surname :
   <input name="txtlastname" type="text"  value="{$row['lastname']}" /><br/>
   Number and Street :
   <input name="txthouse" type="text"  value="{$row['house']}" /><br/>
   Town :
   <input name="txttown" type="text"  value="{$row['town']}" /><br/>
   County :
   <input name="txtcounty" type="text"  value="{$row['county']}" /><br/>
   Country :
   <input name="txtcountry" type="text"  value="{$row['country']}" /><br/>
   Postcode :
   <input name="txtpostcode" type="text"  value="{$row['postcode']}" /><br/>
   <input type="submit" value="Save" name="submit"/>
   </form>

EOD;


   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
