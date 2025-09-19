<?php
include 'session.php';
$username = $_SESSION['username'];
include 'dconn.php';
	$sql = "UPDATE cf_users SET logouttime=NOW() WHERE username LIKE ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($username));
	$sql = "UPDATE cf_users SET status=? WHERE username LIKE ?";
    $q = $pdo->prepare($sql);
    $q->execute(array('OFFLINE' , $username));
session_destroy();
$pdo = null;
$error = "You have successfully Log Out of your account.";	
header("Location: index.php");
?>