<?php
include 'session.php';
$loginid = $_SESSION['loginid'];
include 'dconn.php';
	$sql = 'UPDATE cf_admin SET logouttime=NOW() WHERE loginid LIKE ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($loginid));
	$sql = 'UPDATE cf_admin SET status=? WHERE loginid LIKE ?';
    $q = $pdo->prepare($sql);
    $q->execute(array('OFFLINE' , $loginid));
session_destroy();
$pdo = null;
$error = "You have successfully Log Out of your account.";	
header("Location: index.php");

?>