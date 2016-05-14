<?php
	$showLogSelect=filter_input(INPUT_POST, "showLogSelect");
	$showLogPassword=filter_input(INPUT_POST, "showLogPassword");
	print <<<HERE
		<!DOCTYPE html>
		<html>
			<head>
				<title>{$showLogSelect} log</title>
			</head>
			<body>
HERE;
	if($showLogPassword=="absolute"){
		$showLogFile=$showLogSelect.".log";
		$showLog=fopen($showLogFile, "r");
		while(!feof($showLog)){
			$log=fgets($showLog);
			print "<p>{$log}</p>";
		}
	} else{
		print "Incorrect password.";
	}
	print <<<HERE
			</body>
		</html>
HERE;
?>