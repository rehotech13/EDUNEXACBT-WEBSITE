<?php
date_default_timezone_set('Africa/Lagos');
session_start();
if(isset($_POST['login'])){
if(empty($_POST['username'])
|| empty($_POST['password'])){
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Username & Password are compulsory</div>";
header("location: index.php");
}
else
{
$username = $_POST['username'];
$password = $_POST['password'];
$username = trim($username);
$password = trim($password);
$password = md5($password);
include('dconn.php');
	$sql1 = "SELECT username FROM cf_users WHERE username LIKE ?";
    $ch = $pdo->prepare($sql1);
    $ch->execute(array($username));
	$fe = $ch->fetchColumn();
	if(!$fe)
	{
	$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Invalid Username</div>";
	header("location: index.php");
	}else{
	$sql2 = "SELECT username FROM cf_users WHERE username LIKE ? AND password LIKE ?";
    $ch2 = $pdo->prepare($sql2);
    $ch2->execute(array($username , $password));
	$fe2 = $ch2->fetchColumn();
	if(!$fe2)
	{
	$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Invalid Password</div>";
	header("location: index.php");
	}else{
	$sql3 = "SELECT user_id , fullname , level , photo FROM cf_users WHERE username LIKE ? AND password LIKE ?";
    $q = $pdo->prepare($sql3);
    $q->execute(array($username , $password));
	$q->setFetchMode(PDO::FETCH_ASSOC);
    while ($r = $q->fetch()) {
	$_SESSION['stdid']=($r['user_id']);
	$fullname=($r['fullname']);
	$level=($r['level']);
	$phot=($r['photo']);
	$photo = "master/".$phot;
	if($q){
		$_SESSION['username']=$username;
		$_SESSION['fullname']=$fullname;
		$_SESSION['level']=$level;
		$_SESSION['photo']=$photo;	
	$sql4 = "UPDATE cf_users SET logintime=NOW() , status=? WHERE username LIKE ?";
    $q4 = $pdo->prepare($sql4);
    $q4->execute(array('ONLINE' , $username));
	header("location: dashboard.php"); 
	}else{
	$_SESSION['error'] = "No record found!";
	header("location: index.php");
}}}
$pdo = null;
}}}
?>