<?php
$BUCKET_NAME = 'realdress';
$IAM_KEY     = 'AKIA5FXIKMXZYLR7J3QX';
$IAM_SECRET  = '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';
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
$con = mysqli_connect('us-cdbr-iron-east-05.cleardb.net', 'bb72072205ffd6', '02e9938c', 'heroku_8f1b3bade09a482', 3306) or die('Error: Unable to connect');

//bodySizes, dressSmall, dressMed, dressLarge, dressExtraLarge, dressEElarge
$size_calculated = $_GET['size'];
if ($size_calculated == 2) {
	//small
    $result = mysqli_query($con, "SELECT * FROM dressSmall") or die("Error: Invalid request");
    
    while ($row = mysqli_fetch_array($result)) {
        $keyPath      = '';
        $keyPath      = $row['s3FilePath'];
        $dressArray[] = $keyPath;
        //echo $keyPath;
        
    }
} elseif($size_calculated == 3) {
	//medium
	$result = mysqli_query($con, "SELECT * FROM dressMed") or die("Error: Invalid request");
    
    while ($row = mysqli_fetch_array($result)) {
        $keyPath      = '';
        $keyPath      = $row['s3FilePath'];
        $dressArray[] = $keyPath;
        //echo $keyPath;
        
    }
} elseif($size_calculated == 4) {
	//large
	$result = mysqli_query($con, "SELECT * FROM dressLarge") or die("Error: Invalid request");
    
    while ($row = mysqli_fetch_array($result)) {
        $keyPath      = '';
        $keyPath      = $row['s3FilePath'];
        $dressArray[] = $keyPath;
        //echo $keyPath;
        
    }
} elseif($size_calculated == 5) {
	//extra large
	$result = mysqli_query($con, "SELECT * FROM dressExtraLarge") or die("Error: Invalid request");
    
    while ($row = mysqli_fetch_array($result)) {
        $keyPath      = '';
        $keyPath      = $row['s3FilePath'];
        $dressArray[] = $keyPath;
        //echo $keyPath;
        
    }
} elseif($size_calculated == 6) {
	//extra extra large
	$result = mysqli_query($con, "SELECT * FROM dressEElarge") or die("Error: Invalid request");
    
    while ($row = mysqli_fetch_array($result)) {
        $keyPath      = '';
        $keyPath      = $row['s3FilePath'];
        $dressArray[] = $keyPath;
        //echo $keyPath;
        
    }
} else {
	//shouldn't reach this but just in case
	$result = mysqli_query($con, "SELECT * FROM dressSmall") or die("Error: Invalid request");
    
    while ($row = mysqli_fetch_array($result)) {
        $keyPath      = '';
        $keyPath      = $row['s3FilePath'];
        $dressArray[] = $keyPath;
        //echo $keyPath;
        
    }
}
//echo json_encode($dressArray);
header("Location: ../dress_tool.html?size=".$size_calculated);
//print_r($dressArray);
//}
//$result = mysqli_query($con, "SELECT * FROM s3Files") or die("Error: Invalid request");

// Get path from db
// $keyPath = '';
// while($row = mysqli_fetch_array($result)) {
//    $keyPath = $row['s3FilePath'];
//    echo $keyPath;
//  }
//  // Get file
//  try {
//    $s3 = S3Client::factory(
//      array(
//        'credentials' => array(
//          'key' => $IAM_KEY,
//          'secret' => $IAM_SECRET
//        ),
//        'version' => 'latest',
//        'region'  => 'us-west-1'
//      )
//    );
//    //
//    $result = $s3->getObject(array(
//      'Bucket' => $BUCKET_NAME,
//      'Key'    => $keyPath
//    ));
//    // Display it in the browser
//    header("Content-Type: {$result['ContentType']}");
//    header('Content-Disposition: filename="' . basename($keyPath) . '"');
//    echo $result['Body'];
//  } catch (Exception $e) {
//    die("Error: " . $e->getMessage());
//  }
?>

<script>    
    var passedArray = <?php echo json_encode($dressArray);?>;
	console.log(passedArray);
</script>
<script src="../assets/js/changedress.js"></script>