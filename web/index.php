<!--Retrieves DATABASE_URL config var and extract info on hostname, database, and credentials from that config var-->
$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
);

<!--Handler to query the database-->
$app->get('/db/', function() use($app) {
  $st = $app['pdo']->prepare('SELECT name FROM test_table');
  $st->execute();

  $names = array();
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['name']);
    $names[] = $row;
  }

  return $app['twig']->render('database.twig', array(
    'names' => $names
  ));
});


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
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 upload example</h1>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>
    </body>
</html>

<!--
<?php
$access_key 		= "iam-user-access-key"; //Access Key
$secret_key 		= "iam-user-secret-key"; //Secret Key
$my_bucket			= "mybucket"; //bucket name
$region				= "us-east-1"; //bucket region
$success_redirect	= 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; //URL to which the client is redirected upon success (currently self) 
$allowd_file_size	= "1048579"; //1 MB allowed Size

//dates
$short_date 		= gmdate('Ymd'); //short date
$iso_date 			= gmdate("Ymd\THis\Z"); //iso format date
$expiration_date 	= gmdate('Y-m-d\TG:i:s\Z', strtotime('+1 hours')); //policy expiration 1 hour from now

//POST Policy required in order to control what is allowed in the request
//For more info http://docs.aws.amazon.com/AmazonS3/latest/API/sigv4-HTTPPOSTConstructPolicy.html
$policy = utf8_encode(json_encode(array(
					'expiration' => $expiration_date,  
					'conditions' => array(
						array('acl' => 'public-read'),  
						array('bucket' => $my_bucket), 
						array('success_action_redirect' => $success_redirect),
						array('starts-with', '$key', ''),
						array('content-length-range', '1', $allowd_file_size), 
						array('x-amz-credential' => $access_key.'/'.$short_date.'/'.$region.'/s3/aws4_request'),
						array('x-amz-algorithm' => 'AWS4-HMAC-SHA256'),
						array('X-amz-date' => $iso_date)
						)))); 

//Signature calculation (AWS Signature Version 4)	
//For more info http://docs.aws.amazon.com/AmazonS3/latest/API/sig-v4-authenticating-requests.html	
$kDate = hash_hmac('sha256', $short_date, 'AWS4' . $secret_key, true);
$kRegion = hash_hmac('sha256', $region, $kDate, true);
$kService = hash_hmac('sha256', "s3", $kRegion, true);
$kSigning = hash_hmac('sha256', "aws4_request", $kService, true);
$signature = hash_hmac('sha256', base64_encode($policy), $kSigning);
?>-->
