<?php
	$studentName=filter_input(INPUT_POST, "studentName");
	$quizName=filter_input(INPUT_POST, "quizName");
	$quizDocName=str_replace(" ", "_", $quizName);
	$responses=$_REQUEST["quest"];
	$masFp=fopen($quizDocName.".mas", "r");
	$quizName=fgets($masFp);
	$quizEmail=fgets($masFp);
	$quizPassword=fgets($masFp);
	$questionNumber=1;
	while(!feof($masFp)){
		$currentProblem=fgets($masFp);
		list($question, $answer1, $answer2, $answer3, $answer4, $correct)=explode(":", $currentProblem);
		$answerKey[$questionNumber]=trim($correct);
		$questionNumber++;
	}
	fclose($masFp);
	print <<<HERE
		<!DOCTYPE html>
		<html>
			<head>
				<title>Quiz Grades</title>
			</head>
			<body>
				<center><h1>Grade for {$quizName}, {$studentName}</h1></center>
HERE;
	$numCorrect=0;
	for($i=1;$i<=count($answerKey);$i++){
		if($responses[$i]==$answerKey[$i]){
			print <<<HERE
				<p>Answer to problem #{$i} was correct.</p>
HERE;
			$numCorrect++;
		} else{
			print <<<HERE
				<p style="color:red">Answer to problem #{$i} was incorrect.</p>
HERE;
		}
	}
	$correctPercentage=($numCorrect/count($answerKey))*100;
	print <<<HERE
				<p>You have got {$numCorrect} correct for {$correctPercentage} percent.</p>
			</body>
		</html>
HERE;
	$logFile=$quizDocName.".log";
	date_default_timezone_set("ASIA/KOLKATA");
	$today = date("F j, Y, g:i a");
	//print "Date: $today<br>\n";
	$location = getenv("REMOTE_ADDR");
	//print "Location: $location<br>\n";
	//add results to log file
	$lgfp = fopen($logFile, "a");
	$logLine = $studentName . "\t";
	$logLine .= $today . "\t";
	$logLine .= $location . "\t";
	$logLine .= $numCorrect . "\t";
	$logLine .= $correctPercentage . PHP_EOL;
	fputs($lgfp, $logLine);
	fclose($lgfp);
?>