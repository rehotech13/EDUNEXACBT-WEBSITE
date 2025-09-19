<?php 
session_start();
//include_once('database.php');
include 'dconn.php';
$qno=$_GET['qno'];
$qry16 = "SELECT stdid FROM cf_testattempt WHERE testid LIKE ? AND stdid LIKE ? AND ans IS NOT NULL";
$abs16 = $pdo->prepare($qry16);
$abs16->execute(array($_SESSION['testid'] , $_SESSION['stdid']));
$num = $abs16->rowCount();
$_SESSION['num']= $num;
$qry17 = "SELECT stdid , testid FROM cf_testattempt WHERE quid LIKE ? AND stdid LIKE ? AND testid LIKE ?";
$abs17 = $pdo->prepare($qry17);
$abs17->execute(array($qno , $_SESSION['stdid'] , $_SESSION['testid']));
$numrows = $abs17->rowCount();
$fe = $abs17->fetchColumn();
if($fe) {
}
else {
$qry18 = "INSERT INTO cf_testattempt(stdid , testid , quid) VALUES(?, ?, ?)";
$abs18 = $pdo->prepare($qry18);
$abs18->execute(array($_SESSION['stdid'] , $_SESSION['testid'] , $qno));
}
 ?>