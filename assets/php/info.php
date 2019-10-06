<?php
if (isset($_POST['height']) && isset($_POST['weight']) && isset($_POST['chest']) && isset($_POST['hips'])) {
	$height = $_POST['height'];
	$weight = $_POST['weight'];
	$chest = $_POST['chest'];
	$hips = $_POST['hips'];
	$targetFolder = "../../user_measurements/";
	$fileName = $targetFolder."User.".uniqid('', true).".txt";
	/* File Output Format:
	height value
	weight value
	chest value
	hips value
	*/
	file_put_contents($fileName, $height."\n");
	file_put_contents($fileName, $weight."\n", FILE_APPEND);
	file_put_contents($fileName, $chest."\n", FILE_APPEND);
	file_put_contents($fileName, $hips."\n", FILE_APPEND);
	header("Location: ../../index.html?userfilecreated");
}
?>   
<html>
<head>
<title></title>
</head>
<body></body>
</html>
