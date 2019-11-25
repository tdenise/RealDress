<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
if (isset($_POST['submitD'])) {
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
			$fileDestination = '../img/'.$fileNameNew;
			move_uploaded_file($filesTmpName, $fileDestination);
			header("Location: ../../index.html?uploadsuccess");
		} else {
			echo "Error Uploading File";
			header("Location: ../../upload.html?uploadFail");
		}
	} else {
		echo "Invalid File Type\n";
		echo "Valid File Types: png";
		header("Location: ../../upload.html?uploadFail");
	}
} else if(isset($_POST['submitG'])) {
	$file = $_FILES['file'];
	
	$filesName = $_FILES['file']['name'];
	$filesTmpName = $_FILES['file']['tmp_name'];
	$filesSize = $_FILES['file']['size'];
	$filesError = $_FILES['file']['error'];
	$filesType = $_FILES['file']['type'];

	$fileExt = explode('.', $filesName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowedExt = array('png');
	
	if(in_array($fileActualExt, $allowedExt)){
		if($filesError === 0){
			$fileNameNew = reset($fileExt)."_".uniqid('', true).".".$fileActualExt;
			$fileDestination = '../gallery/'.$fileNameNew;
			move_uploaded_file($filesTmpName, $fileDestination);
			header("Location: ../../index.html?uploadsuccess");
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
} else {
	header("Location: ../../login.html?adminLogin");
}
?>