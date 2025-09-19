<?php
session_start();
//include_once('database.php');
include 'dconn.php';
$ans=$_POST['RadioGroup1'];
$qry12 = "UPDATE cf_testattempt SET ans=? , correctans=? WHERE quid LIKE ? AND stdid LIKE ? AND testid LIKE ?";
$abs12 = $pdo->prepare($qry12);
$abs12->execute(array($ans , $_SESSION['cor'] , $_SESSION['qno'] , $_SESSION['stdid'] , $_SESSION['testid']));
$qry13 = "UPDATE cf_timer SET stop=NOW() WHERE studentid LIKE ? AND testid LIKE ?";
$abs13 = $pdo->prepare($qry13);
$abs13->execute(array($_SESSION['username'] , $_SESSION['testid']));
$qry14 = "SELECT start , stop FROM cf_timer WHERE studentid LIKE ? AND testid LIKE ?";
$abs14 = $pdo->prepare($qry14);
$abs14->execute(array($_SESSION['username'] , $_SESSION['testid']));
$abs14->setFetchMode(PDO::FETCH_ASSOC);
while ($ra14 = $abs14->fetch()) {
$start=strtotime($ra14['start']);
$stop=strtotime($ra14['stop']);
$diff=($stop - $start);
}
$qry15 = "UPDATE cf_timer SET spent=? WHERE studentid LIKE ? AND testid LIKE ?";
$abs15 = $pdo->prepare($qry15);
$abs15->execute(array($diff , $_SESSION['username'] , $_SESSION['testid']));
 ?>