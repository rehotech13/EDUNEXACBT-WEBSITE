<?php  
include 'session.php';
//include_once('database.php');
include 'dconn.php';
$tqu=$_SESSION['questno'];
$ab13 = "SELECT * FROM cf_testattempt WHERE stdid LIKE ? AND testid LIKE ? AND ans=correctans";
$abzq13 = $pdo->prepare($ab13);
$abzq13->execute(array($_SESSION['stdid'] , $_SESSION['testid']));
$numrows2 = $abzq13->rowCount();
$score=$numrows2/$tqu*100;
echo $score.'%';
$username=$_SESSION['username'];
$passmark=$_SESSION['passmark'];
$display=$_SESSION['userresult'];
$repeatable=$_SESSION['repeatable'];
$tid=$_SESSION['testid'];
$siql2 = "INSERT INTO cf_results(userid , test_id , score , tqu , mark , passmark , display , repeatable , testdate) VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())";
$ssqsw = $pdo->prepare($siql2);
$ssqsw->execute(array($username , $tid , $numrows2 , $tqu , $score , $passmark , $display , $repeatable));
$sqde = "DELETE FROM cf_timer WHERE studentid LIKE ? AND testid LIKE ?";
$qde = $pdo->prepare($sqde);
$qde->execute(array($username , $tid));
session_destroy();
 ?>