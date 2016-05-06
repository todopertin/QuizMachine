<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php
			$showQuiz=filter_input(INPUT_POST, "showTestSelect");
			getFile();
			getData();
			printQuiz();
			function getFile(){
				global $showQuiz;
				$quiz=file($showQuiz.".mas");
				$counter=0;
				while($counter<count($quiz)){
					$questions[]=$quiz[$counter];
					$counter+=2;
				}
				$counter=1;
				while($counter<count($quiz)){
					$answers[]=$quiz[$counter];
					$counter+=2;
				}
				for($i=0;$i<count($answers);$i++){
					$choice[]=explode(":", $answers[$i]);
				}
				print <<<HERE
					<fieldset>
						<form method="post" action="gradeQuiz.php">
HERE;
				for($i=0;$i<count($questions);$i++){
					$si=$i+1;
					print <<<HERE
						<p>
							$si. $questions[$i]<br/>
HERE;
						for($j=0;$j<4;$j++){
							print <<<HERE
								<input type="radio" name="chosen[$i]" value="{$choice[$i][$j]}">{$choice[$i][$j]}</input><br/>
HERE;
						}
					print <<<HERE
							<input type="hidden" name="correctAnswer[$i]" value="{$choice[$i][4]}"/>
						</p>
						<hr/>
HERE;
				}
				print <<<HERE
							<input type="submit" name="submit" value="submit quiz"/>
						</form>
					</fieldset>
HERE;
			}
			function getData(){
			}
			function printQuiz(){
			}
		?>
	</body>
</html>
