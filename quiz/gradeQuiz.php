<!DOCTYPE html>
<html>
	<head>
		<title>gradeQuiz.php</title>
	</head>
	<body>
		<?php
			$formData=filter_input_array(INPUT_POST);
			$chosen=$formData["chosen"];
			$correctAnswer=$formData["correctAnswer"];
			for($i=0;$i<count($chosen);$i++){
				if($chosen[$i]==rtrim($correctAnswer[$i])){
					print "Correct!<br/>";
				} else{
					print "Super wrong.<br/>";
				}
			}
		?>
	</body>
</html>
