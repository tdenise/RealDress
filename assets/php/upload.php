<?php
if (isset($_POST['submit'])) {
	$file = $_FILES['file'];
	
	$filesName = $_FILES['file']['name'];
	$filesTmpName = $_FILES['file']['tmp_name'];
	$filesSize = $_FILES['file']['size'];
	$filesError = $_FILES['file']['error'];
	$filesType = $_FILES['file']['type'];

	$fileExt = explode('.', $filesName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowedExt = array('jpg', 'jpeg', 'png');
	
	if(in_array($fileActualExt, $allowedExt)){
		if($filesError === 0){
			$fileNameNew = reset($fileExt)."_".uniqid('', true).".".$fileActualExt;
			$fileDestination = 'uploaded_images/'.$fileNameNew;
			move_uploaded_file($filesTmpName, $fileDestination);
			header("Location: index.html?uploadsuccess");
		} else {
			echo "Error Uploading File";
			header("Location: ../../upload.html?uploadFail");
		}
	} else {
		echo "Invalid File Type\n";
		echo "Valid File Types: jpg, jpeg, png";
		header("Location: ../../upload.html?uploadFail");
	}
}
?>