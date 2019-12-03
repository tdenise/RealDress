<?php
	require '../vendor/autoload.php';
	
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	// AWS Info
	$bucketName = 'realdress';
	$IAM_KEY = 'AKIA5FXIKMXZYLR7J3QX';
	$IAM_SECRET = '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';
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'us-west-1',
				'scheme' => 'http'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}
	
	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$keyName = 'user_uploads/' . basename($_FILES['myFile']['name'] . "_dress");
	$pathInS3 = 'https://s3.us-west-1.amazonaws.com/' . $bucketName . '/' . $keyName;
	// Add it to S3
	$fileExt = explode('.', $_FILES['myFile']['name']);
	$fileActualExt = strtolower(end($fileExt));
	$fileActualExt = strtolower(end($fileExt));
	$allowedExt = array('png');
	try {
		if(in_array($fileActualExt, $allowedExt)){
		// Uploaded:
		$file = $_FILES['myFile']['tmp_name'];
		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY'
			)
		);
		} else {
			echo "Invalid File Type\n";
			header("Location: ../upload.html?uploadFail");
		}
	} catch (S3Exception $e) {
		header("Location: ../upload.html?uploadFail");
		//echo'Error: ' . $e->getMessage();
	} catch (Exception $e) {
		header("Location: ../upload.html?uploadFail");
		//echo 'Error: ' . $e->getMessage();
	}
	header("Location: ../upload.html?uploadSuccess");

    // Save file to files table - TODO

    // Create access code
    
    $ACCESS_CODE = '1234567';

    $con = mysqli_connect('localost', 'root', 'root', 's3DB') or die('Error: Unable to connect');
    
    mysqli_query($con, "INSERT INTO s3Files(s3FilePath, accessCode) VALUES ('$keyName', '$ACCESS_CODE')") or die ('error: not able to save');
    
    echo 'Done';
} else {
	header("Location: ../../login.html?adminLogin");
}
?>