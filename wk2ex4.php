<!--Speed Camera Advise Script>-->

/* This script demonstrates the use of conditional statments to */ 
/* check the variable value againt the conditions to display the */ 
/* appropriate output. */

<?php 
	
	$points = 13;
	//Output appropriate message depending on points awarded;

	if ($points > 12) {
			echo "Public transport is your best option. <br/>";
	}elseif ($points >= 9){
		echo "If you get caught say your grandmother was driving. <br/>";
	}else{
		echo "There is no need to worry about the speed limit. <br/>";
	}
?>
