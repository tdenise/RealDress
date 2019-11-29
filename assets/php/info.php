<?php
session_start();

if (isset($_POST['height']) && isset($_POST['chest']) && isset($_POST['waist']) && isset($_POST['hips'])) {
	$height = $_POST['height'];
	$waist = $_POST['waist'];
	$chest = $_POST['chest'];
	$hips = $_POST['hips'];
	$targetFolder = "../profile/";
	$fileName = $targetFolder."User_".uniqid('', true).".txt";
	/* File Output Format:
	height value
	waist value
	chest value
	hips value
	*/
	file_put_contents($fileName, $height."\n");
	file_put_contents($fileName, $waist."\n", FILE_APPEND);
	file_put_contents($fileName, $chest."\n", FILE_APPEND);
	file_put_contents($fileName, $hips."\n", FILE_APPEND);
	header("Location: ../../index.html?userfilecreated");
}
?>
