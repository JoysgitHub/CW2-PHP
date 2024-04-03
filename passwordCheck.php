<?php




function complexityChecker($password):bool{
	$upperLetters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
	$lowerLetters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	$numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$symbols = array(
    '!', '@', '#', '%', '^', '&', '*', '(', ')',
    '-', '_', '=', '+', '[', ']', '{', '}', '|', '\\',
    ';', ':', '"', '\'', ',', '.', '<', '>', '/', '?');

	$uLetters = false;
	$lLetters = false;
	$num = false;
	$symb = false;

	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $upperLetters)) {
			$uLetters = true;
			echo "Ulet: TRUE<br/>";
		}
	}
	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $lowerLetters)) {
			$lLetters = true;
			echo "LLet: TRUE<br/>";
		}
	}
	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $numbers)) {
			$num= true;
			echo "NUM: TRUE<br/>";
		}
	}
	for ($i=0; $i < strlen($password); $i++) { 
		if (in_array($password[$i], $symbols)) {
			$symb= true;
			echo "SYMB: TRUE<br/>";
		}
	}

	if ($uLetters == true && $lLetters == true && $num == true && $symb == true) {
		 
		return true;
	}else {
		return false;
	}

}




?>
