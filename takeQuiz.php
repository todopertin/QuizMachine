<?php
	$quizFile=filter_input(INPUT_POST, "showTestSelect");
	$quizPassword=filter_input(INPUT_POST, "showTestPassword");
	$masFp=fopen($quizFile.".mas", "r");
	$dummy=fgets($masFp);
	$dummy=fgets($masFp);
	$magicWord=fgets($masFp);
	$magicWord=rtrim($magicWord);
	fclose($masFp);
	if($quizPassword==$magicWord){
		readFile($quizFile.".html");
	} else{
		print <<<HERE
			<!DOCTYPE html>
			<html>
				<head>
					<title>{$quizFile} error - incorrect password</title>
				</head>
				<body>
					<p>Incorrect password.
				</body>
			</html>
HERE;
	}
?>