<?php
if (isset($_POST['submit'])){
	if($_POST['table'] == 'classes')
	{header("location: import/classes.php");}
	elseif($_POST['table'] == 'users')
	{header("location: import/users.php");}
	elseif($_POST['table'] == 'subjects')
	{header("location: import/subjects.php");}
	elseif($_POST['table'] == 'tests')
	{header("location: import/tests.php");}
	elseif($_POST['table'] == 'questions')
	{header("location: import/questions.php");}
	else{header("location: import/results.php");}
	}
?>