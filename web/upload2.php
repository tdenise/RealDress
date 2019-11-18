<!--script that accepts a file to upload in the browser, and stores it on S3 under the same name it had on the client’s computer.-->
<?php
require('vendor/autoload.php');

// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = new Aws\S3\S3Client([
    'version'  => '2006-03-01',
    'region'   => 'us-west-1',
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>



<!--_____________________________________________________-->
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
if (isset($_POST['submitD'])) {	
	$filesName = $_FILES['file']['name'];
	$filesTmpName = $_FILES['file']['tmp_name'];
	$filesSize = $_FILES['file']['size'];
	$filesType = $_FILES['file']['type'];
    $filesError = $_FILES['file']['error'];

	$fileExt = explode('.', $filesName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowedExt = array('jpg', 'jpeg', 'png');
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['myfile']) && $_FILES['myfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['myfile']['tmp_name'])){
		if($filesError === 0){
            $upload = $s3->upload($bucket, $_FILES['myfile']['name'], fopen($_FILES['myfile']['tmp_name'], 'rb'), 'public-read');
			header("Location: ../../index.html?uploadsuccess");
		} else {
			echo "Error Uploading File";
			header("Location: ../../upload2.html?uploadFail");
		}
	} else {
		echo "Invalid File Type\n";
		echo "Valid File Types: jpg, jpeg, png";
		header("Location: ../../upload2.html?uploadFail");
	}
}}
?>
