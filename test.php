<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	echo "POSTED<br/>";
if (isset($_FILES['studentImage'])) {

	echo "IMAGE RECIEVED<br/>";

	$image = $_FILES['studentImage']['tmp_name'];

	$imagedata = addslashes(file_get_contents($image));

	if (!exif_imagetype($image)) {
		echo "NOT IMAGE<br/>";
	}else {
		echo "IMAGE CONFIRMED<br/>";
	}
	
}
}







?>



<form method='post' enctype='multipart/form-data'   action='<?php echo $_SERVER['PHP_SELF']?>'>
<input type='file' name='studentImage' accept='image/jpeg, image/jpg' required><br/>
<input type='submit'  >
</form>
