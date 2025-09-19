<?php
session_start();
if(isset($_POST['submit'])){
if(empty($_POST['username'])
|| empty($_POST['password']) 
|| empty($_POST['cpassword'])
|| empty($_POST['security'])
|| empty($_POST['csecurity'])
|| empty($_POST['sampled'])){
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>All fields are compulsory</div>";
header("location: step3.php");
}
elseif($_POST['password']!=$_POST['cpassword']){
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password and Confirm Password not matched</div>";
header("location: step3.php");
}
elseif($_POST['security']!=$_POST['csecurity']){
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Security Key and Confirm Security Key not matched</div>";
header("location: step3.php");
}
else
{
$username = $_POST['username'];
$password = $_POST['password'];
$security = $_POST['security'];
$sampled = $_POST['sampled'];
$username = htmlspecialchars(trim($username));
$password = htmlspecialchars(trim($password));
$security = htmlspecialchars(trim($security));
$sampled = htmlspecialchars(trim($sampled));
$password = md5($password);
$security = sha1($security);
include '../dconn.php';
	$sql = 'SELECT * FROM cf_admin';
    $ch = $pdo->prepare($sql);
    $ch->execute(array());
	$fe = $ch->fetchColumn();
	if($fe)
	{
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Sorry, this software has already been installed. Click <a href='../master'>here for Administrative page and login</a> or Click <a href='../index.php'>here for CBT Home</a></div>";
header("location: step3.php");
	}else{
if($sampled== "no"){
$sql2 = "INSERT INTO cf_admin(loginid , password , security , status) VALUES(?, ?, ?, ?)";
    $q = $pdo->prepare($sql2);
    $q->execute(array($username , $password , $security , 'OFFLINE'));
	$sql3 = "INSERT INTO cf_crp(fluxtech , flink , fedition , fno) VALUES(?, ?, ?, ?)";
    $q3 = $pdo->prepare($sql3);
    $q3->execute(array('FLUXTECH CONCEPTS' , 'http://www.fluxtechng.com' , '4' , '08068782879'));
	if($q){
	$_SESSION['newad'] = $username;
$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Congratulations, CBTflux has been installed successfully and Admin user created.</div>";
header("location: final.php");
     }else{
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to add new admin, try again</div>";
header("location: step3.php");
}
}else{
	$sql2 = "INSERT INTO cf_admin(loginid , password , security , status) VALUES(?, ?, ?, ?)";
    $q = $pdo->prepare($sql2);
    $q->execute(array($username , $password , $security , 'OFFLINE'));
	$sql3 = "INSERT INTO cf_crp(fluxtech , flink , fedition , fno) VALUES(?, ?, ?, ?)";
    $q3 = $pdo->prepare($sql3);
    $q3->execute(array('FLUXTECH CONCEPTS' , 'http://www.fluxtechng.com' , '4' , '08068782879'));
	$sql4 = "INSERT INTO cf_classes(classes) VALUES(?)";
    $q4 = $pdo->prepare($sql4);
    $q4->execute(array('JSS 1'));
	$sql5 = "INSERT INTO cf_subjects(subcode , subtitle , class) VALUES(?, ?, ?)";
    $q5 = $pdo->prepare($sql5);
    $q5->execute(array('ENG-11' , 'English Language' , 'JSS 1'));
	$sql6 = "INSERT INTO cf_test(name , sub_id , class , questno , timemi , enable , passmark , userresult , repeatable) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $q6 = $pdo->prepare($sql6);
    $q6->execute(array('English Exam First Term' , '1' , 'JSS 1' , '5' , '2' , 'Enabled' , '50' , 'Yes' , 'No'));
	$sql7 = "INSERT INTO cf_users(fullname , username , password , level , gender , photo , status , logintime , logouttime) VALUES(?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $q7 = $pdo->prepare($sql7);
    $q7->execute(array('Sample User' , 'fcn001' , '2b351906cf0a43c36c8dda1031168f14' , 'JSS 1' , 'Male' , 'usrimg/sample.jpg' , 'OFFLINE'));
	$sql8 = "INSERT INTO cf_question(test_id , qno , question , option1 , option2 , option3 , option4 , correctanswer) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q8 = $pdo->prepare($sql8);
    $q8->execute(array('1' , '1' , 'What is a noun?' , 'I dont know' , 'I cant say' , 'Name of a person, animal, place or thing' , 'Please tell me' , 'Name of a person, animal, place or thing'));
	$sql9 = "INSERT INTO cf_question(test_id , qno , question , option1 , option2 , option3 , option4 , correctanswer) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q9 = $pdo->prepare($sql9);
    $q9->execute(array('1' , '2' , 'What is a pronoun?' , 'Name used instead of noun' , 'I cant say' , 'Name of a person' , 'Please hint me' , 'Name used instead of noun'));
	$sql10 = "INSERT INTO cf_question(test_id , qno , question , option1 , option2 , option3 , option4 , correctanswer) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q10 = $pdo->prepare($sql10);
    $q10->execute(array('1' , '3' , 'What is a verb?' , 'Name used instead of noun' , 'An action word' , 'Name of a person' , 'I dont know' , 'An action word'));
	$sql10 = "INSERT INTO cf_question(test_id , qno , question , option1 , option2 , option3 , option4 , correctanswer) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q10 = $pdo->prepare($sql10);
    $q10->execute(array('1' , '4' , 'What is an adjective?' , 'Adjective nani' , 'Words used to qualify a noun' , 'You tell me' , 'I dont know' , 'Words used to qualify a noun'));
	$sql11 = "INSERT INTO cf_question(test_id , qno , question , option1 , option2 , option3 , option4 , correctanswer) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q11 = $pdo->prepare($sql11);
    $q11->execute(array('1' , '5' , 'Official language in Nigeria is ______________' , 'Spanish' , 'French' , 'Arabic' , 'English' , 'English'));
	if($q){
	$_SESSION['newad'] = $username;
$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Congratulations, CBTflux has been installed successfully and Admin user created.<br><br>Sample Data have been installed with <b>fcn001</b> as both student's Username and Password</div>";
header("location: final.php");
     }else{
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to add new admin, try again</div>";
header("location: step3.php");
            }}}
$pdo = null;
}}
?>