<?php
    $bucketName = 'realdress';
    $IAM_KEY = 'AKIA5FXIKMXZYLR7J3QX';
	$IAM_SECRET = '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';
  require '../vendor/autoload.php';
  use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;
  // Get the access code
  $accessCode = $_GET['c'];
  $accessCode = strtoupper($accessCode);
  $accessCode = trim($accessCode);
  $accessCode = addslashes($accessCode);
  $accessCode = htmlspecialchars($accessCode);
  // Connect to database
  $con = mysqli_connect('192.168.2.27', 'root', '02e9938c', 'cleardb', 3306) or die('Error: Unable to connect');
  // Verify valid access code
  $result = mysqli_query($con, "SELECT * FROM s3Files WHERE accessCode='$accessCode'") or die("Error: Invalid request");
  if (mysqli_num_rows($result) != 1) {
    die("Error: Invalid access code");
  }
  
  // Get path from db
  $keyPath = '';
  while($row = mysqli_fetch_array($result)) {
    $keyPath = $row['s3FilePath'];
  }
  // Get file
  try {
    $s3 = S3Client::factory(
      array(
        'credentials' => array(
          'key' => $IAM_KEY,
          'secret' => $IAM_SECRET
        ),
        'version' => 'latest',
        'region'  => 'us-west-1'
      )
    );
    //
    $result = $s3->getObject(array(
      'Bucket' => $BUCKET_NAME,
      'Key'    => $keyPath
    ));
    // Display it in the browser
    header("Content-Type: {$result['ContentType']}");
    header('Content-Disposition: filename="' . basename($keyPath) . '"');
    echo $result['Body'];
  } catch (Exception $e) {
    die("Error: " . $e->getMessage());
  }
  ?>