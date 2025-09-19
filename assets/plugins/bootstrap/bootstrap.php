<?php
include 'dconn.php';
$sql1 = 'SELECT * FROM cf_crp';
$cq = $pdo->query($sql1);
$cq->setFetchMode(PDO::FETCH_ASSOC);
while ($ra = $cq->fetch()) {
$fluxtech_concepts=$ra['fluxtech'];
$www_fluxtechng_com=$ra['flink'];
$fedition=$ra['fedition'];
$fluxtech_no=$ra['fno'];
$_SESSION['fedition']=$fedition;
}if($fluxtech_concepts !=='FLUXTECH CONCEPTS'){
header("location: error.php");
}elseif($www_fluxtechng_com !=='http://www.fluxtechng.com'){
header("location: error.php");
}else{}
?>