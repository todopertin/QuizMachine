<?php
	$quizName=filter_input(INPUT_POST, "quizName");
	$quizEmail=filter_input(INPUT_POST, "quizEmail");
	$quizPassword=filter_input(INPUT_POST, "quizPassword");
	$quizData=filter_input(INPUT_POST, "quizData");
	$fileBase=str_replace(" ", "_", $quizName);
	$htmlFp=fopen($fileBase.".html", "w");
	$htmlData=buildHtml();
	fputs($htmlFp, $htmlData);
	fclose($htmlFp);
	$masFp=fopen($fileBase.".mas", "w");
	$masData=buildMas();
	fputs($masFp, $masData);
	fclose($masFp);
	function buildHtml(){
		global $quizName, $quizData;
		$htmlFile=<<<HERE
			<!DOCTYPE html>
			<html>
				<head>
					<title>{$quizName}</title>
				</head>
				<body>
					<h1>$quizName</h1>
					<fieldset>
						<form method="post" action="gradeQuiz.php">
							<label>Name: </label><input type="text" name="studentName"/>
								<ol>
HERE;
							$problems=explode("\n", $quizData);
							$questionNumber=1;
							foreach($problems as $currentProblem){
								list($question, $answerA, $answerB, $answerC, $answerD, $correct)=explode(":", $currentProblem);
								$htmlFile.=<<<HERE
										<li>$question</li>
										<ol>
											<li><input type="radio" name="quest[$questionNumber]" value="A"/>$answerA</li>
											<li><input type="radio" name="quest[$questionNumber]" value="B"/>$answerB</li>
											<li><input type="radio" name="quest[$questionNumber]" value="C"/>$answerC</li>
											<li><input type="radio" name="quest[$questionNumber]" value="D"/>$answerD</li>
										</ol>
									<hr/>
HERE;
								$questionNumber++;
							}
						$htmlFile.=<<<HERE
								</ol>
							<input type="hidden" name="quizName" value="$quizName"/>
							<input type="submit" value="submit"/>
						</form>
					</fieldset>
				</body>
			</html>
HERE;
		return $htmlFile;
	}
	function buildMas(){
		global $quizName, $quizEmail, $quizPassword, $quizData;
		$masFile=$quizName."\n";
		$masFile.=$quizEmail."\n";
		$masFile.=$quizPassword."\n";
		$masFile.=$quizData;
		return $masFile;
	}
?>