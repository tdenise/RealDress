<?php
session_start();

if (isset($_POST['height']) && isset($_POST['chest']) && isset($_POST['waist']) && isset($_POST['hips'])) {
	$height = $_POST['height'];
	$waist = $_POST['waist'];
	$chest = $_POST['chest'];
	$hips = $_POST['hips'];
//$size_chest (1-6)
	if($chest < 33.5){
		$size_chest = 1;
	} elseif ($chest >= 33.5 && $chest < 35){
		$size_chest = 2;
	} elseif ($chest >= 35 && $chest < 36.5){
		$size_chest = 3;
	} elseif ($chest >= 36.5 && $chest < 38){
		$size_chest = 4;
	} elseif ($chest >= 38 && $chest < 39.5){
		$size_chest = 5;
	} elseif ($chest >= 39.5){
		$size_chest = 6;
	}
//$size_waist (1-6)	
	if($waist < 24){
		$size_waist = 1;
	} elseif ($waist >= 24 && $waist < 25.5){
		$size_waist = 2;
	} elseif ($waist >= 25.5 && $waist < 27){
		$size_waist = 3;
	} elseif ($waist >= 27 && $waist < 28.5){
		$size_waist = 4;
	} elseif ($waist >= 28.5 && $waist < 30){
		$size_waist = 5;
	} elseif ($waist >= 30){
		$size_waist = 6;
	}
//$size_hips (1-6)	
	if($hips < 33.5){
		$size_hips = 1;
	} elseif ($hips >= 33.5 && $hips < 35){
		$size_hips = 2;
	} elseif ($hips >= 35 && $hips < 36.5){
		$size_hips = 3;
	} elseif ($hips >= 36.5 && $hips < 38){
		$size_hips = 4;
	} elseif ($hips >= 38 && $hips < 39.5){
		$size_hips = 5;
	} elseif ($hips >= 39.5){
		$size_hips = 6;
	}
	
//$size_calculated Average of chest, waist, and hips (1-6)
	$size_calculated = ($size_chest + $size_waist + $size_hips)/3;
	
	$targetFolder = "../../user_profiles/";
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
	file_put_contents($fileName, $size_calculated."\n", FILE_APPEND);
	header("Location: ../../index.html?userfilecreated");
}
?>
