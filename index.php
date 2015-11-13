<?php 

/*
	require_once("DB.php");
		ini_set('max_execution_time', 3600);
	$dictionary = "largedictionary.txt";
	print("test");
	$file = fopen($dictionary,"r");
	if(!$file){
		print("coule not open file. ");
	}

	while(!feof($file)){
		$line = fgets($file);
		print($line);
		$stmt = $dbh->prepare("INSERT INTO `Words` (`word`) VALUES (?)");
		$stmt->bindParam(1,$line);
		$stmt->execute();
	}
	print("Complete");
	fclose($file);
*/

	//will implement with pulling from database later

	require_once("Dictionary.php");
	$case=0;
	if($_POST){
		if(isset($_POST['StringA']) && isset($_POST['StringB'])){
			$WordDictionary = new Dictionary();
			$ShortestPath = $WordDictionary->WordLadderCompute($_POST['StringA'],$_POST['StringB']);
			$case = 1;
		}
		else{
			$case = 0;
		}
	}

	require_once("WordLadder.php");
?>