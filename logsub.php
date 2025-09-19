<?php  
include 'session.php';
//include_once('database.php');
include 'dconn.php';
$sql4 = "UPDATE cf_timer SET stop=NOW() WHERE studentid LIKE ? AND testid LIKE ?";
$q4 = $pdo->prepare($sql4);
$q4->execute(array($_SESSION['username'] , $_SESSION['testid']));
$sql1 = "SELECT start , stop , spentold FROM cf_timer WHERE studentid LIKE ? AND testid LIKE ?";
$q1 = $pdo->prepare($sql1);
$q1->execute(array($_SESSION['username'] , $_SESSION['testid']));
$q1->setFetchMode(PDO::FETCH_ASSOC);
while ($ra1 = $q1->fetch()) {
$start=strtotime($ra1['start']);
$stop=strtotime($ra1['stop']);
$spentold=$ra1['spentold'];
$diff=($stop-$start);
}
$real=$spentold+$diff;
$sql2 = "UPDATE cf_timer SET spentold=? WHERE studentid LIKE ? AND testid LIKE ?";
$q2 = $pdo->prepare($sql2);
$q2->execute(array($real , $_SESSION['username'] , $_SESSION['testid']));
$qsql2 = "UPDATE cf_timer SET spent=? WHERE studentid LIKE ? AND testid LIKE ?";
$qq2 = $pdo->prepare($qsql2);
$qq2->execute(array('0' , $_SESSION['username'] , $_SESSION['testid']));
$qwsql = "UPDATE cf_users SET logouttime=NOW() WHERE username LIKE ?";
$qwq = $pdo->prepare($qwsql);
$qwq->execute(array($username));
$assql = "UPDATE cf_users SET status=? WHERE username LIKE ?";
$asq = $pdo->prepare($assql);
$asq->execute(array('OFFLINE' , $username));
session_destroy();
$pdo = null;
header("location: index.php");
 ?>