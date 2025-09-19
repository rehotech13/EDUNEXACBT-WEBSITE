<?php
include 'dconn.php';
$sql1 = "SELECT * FROM cf_crp";
$cq = $pdo->query($sql1);
$cq->setFetchMode(PDO::FETCH_ASSOC);
while ($ra = $cq->fetch()) {
$fluxtech=$ra['fluxtech'];
$flink=$ra['flink'];
$fedition=$ra['fedition'];
$_SESSION['fedition']=$fedition;
}if($fluxtech !=='FLUXTECH CONCEPTS'){
header("location: ../error.php");
}elseif($flink !=='http://www.fluxtechng.com'){
header("location: ../error.php");
}else{}
?>