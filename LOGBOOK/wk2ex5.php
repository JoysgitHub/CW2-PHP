<?php 

//This script checks for "MSIE" in the returned user-agent
//if "MSIE" is found it returns "You are using Internet Explorer"
//else it returns "Why are you not using Internet Explorer". 

if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE") != false){
	echo "You are using Internet Explorer <br/>";
}else{
	echo "Why are you not using Internet Explorer ? <br/>";
}

?>
