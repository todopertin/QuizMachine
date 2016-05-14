<!DOCTYPE html>
<html>
	<head>
		<title>Edit Quiz</title>
	</head>
	<body>
		<?php
			$quizPassword=filter_input(INPUT_POST, "showEditPassword");
			$editFile=filter_input(INPUT_POST, "showEditSelect");
			if($quizPassword!="absolute"){
				print <<<HERE
					<p>Incorrect password.</p>
HERE;
			} else{
				$fileName=filter_input(INPUT_POST, "showEditSelect");
				if($fileName=="new"){
					$quizName = "sample test";
					$quizEmail = "root@localhost";
					$quizPassword = "php";
					$quizData = "q:a:b:c:d:correct";
				} else{
					$fileName.=".mas";
					$fp=fopen($fileName, "r");
					$quizName=fgets($fp);
					$quizEmail=fgets($fp);
					$quizPassword=fgets($fp);
					$quizData="";
					while(!feof($fp)){
						$quizData.=fgets($fp);
					}
				}
				print <<<HERE
					<center>
						<fieldset>
							<form method="post" action="writeQuiz.php">
								<p><label>Quiz name:  </label><input type="text" name="quizName" value="{$quizName}"/></p>
								<p><label>Quiz email:  </label><input type="email" name="quizEmail" value="{$quizEmail}"/></p>
								<p><label>Quiz password:  </label><input type="text" name="quizPassword" value="{$quizPassword}"/></p>
								<p><textarea name="quizData" rows="15" cols="40">$quizData</textarea></p>
								<p><input type="submit" value="save quiz"/></p>
							</form>
						</fieldset>
					</center>
HERE;
			}
		?>
	</body>
</html>