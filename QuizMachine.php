<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Quiz Builder</title>
		<link rel = "stylesheet" type = "text/css" href = "quiz.css" />
	</head>
	<body>
		<center>
			<h1>Quiz Machine</h1>
			<?php
				getFiles();
				showTest();
				showEdit();
				showLog();
				function getFiles(){
					global $fileNames;
					$quizFolder="./quiz";
					$quiz=opendir($quizFolder);
					chdir($quizFolder);
					$currentFile="";
					while($currentFile!==FALSE){
						$currentFile=readdir($quiz);
						$fileNames[]=$currentFile;
					}
				}
				function showTest(){
					global $fileNames;
					$fileBase=preg_grep("/mas$/", $fileNames);
					$select=<<<HERE
						<select name="showTestSelect">
HERE;
					foreach($fileBase as $fileName){
						$filePart=substr($fileName, 0, strlen($fileName)-4);
						$select.=<<<HERE
							<option value="$filePart">$filePart</option>
HERE;
					}
					$select.=<<<HERE
						</select>
HERE;
					print <<<HERE
						<p>
							<fieldset>
								<h2>Take a quiz</h2>
								<form action="./quiz/takeQuiz.php" method="post">
									<p><label>Quiz password:  </label><input type="password" name="showTestPassword"/></p>
									<p><label>Quiz:  </label>$select</p>
									<p><input type="submit" name="showTestSubmit" value="Take quiz"/></p>
								</form>
							</fieldset>
						</p>
HERE;
				}
				function showEdit(){
					global $fileNames;
					$fileBase=preg_grep("/mas$/", $fileNames);
					$select=<<<HERE
						<select name="showEditSelect">
HERE;
					foreach($fileBase as $fileName){
						$filePart=substr($fileName, 0, strlen($fileName)-4);
						$select.=<<<HERE
							<option value="$filePart">$filePart</option>
HERE;
					}
					$select.=<<<HERE
							<option value="new">new quiz</option>
						</select>
HERE;
					print <<<HERE
						<p>
							<fieldset>
								<h2>Edit/create a quiz</h2>
								<form action="./quiz/editQuiz.php" method="post">
									<p><label>Admin password:  </label><input type="password" name="showEditPassword"/></p>
									<p><label>Quiz:  </label>$select</p>
									<p><input type="submit" name="showEditSubmit" value="Edit quiz"/></p>
								</form>
							</fieldset>
						</p>
HERE;
				}
				function showLog(){
					global $fileNames;
					$fileBase=preg_grep("/log$/", $fileNames);
					$select=<<<HERE
						<select name="showLogSelect">
HERE;
					foreach($fileBase as $fileName){
						$filePart=substr($fileName, 0, strlen($fileName)-4);
						$select.=<<<HERE
							<option value="$filePart">$filePart</option>
HERE;
					}
					$select.=<<<HERE
						</select>
HERE;
					print <<<HERE
						<p>
							<fieldset>
								<h2>View a quiz log</h2>
								<form action="./quiz/viewLog.php" method="post">
									<p><label>Admin password:  </label><input type="password" name="showLogPassword"/></p>
									<p><label>Quiz:  </label>$select</p>
									<p><input type="submit" name="showLogSubmit" value="Show log"/></p>
								</form>
							</fieldset>
						</p>
HERE;
				}
			?>
		</center>
	</body>
</html>
