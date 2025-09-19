<?php		
ob_start();
include 'session.php';
include 'dconn.php';
$id = ($_GET["id"]);
$sq = 'DELETE FROM cf_classes WHERE class_id LIKE ?';
$q = $pdo->prepare($sq);
$q->execute(array($id));
if($sq){
$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Class Deleted</div>";
header("location: classes.php");
}else{
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to delete Class, try again later</div>";
header("location: classes.php");
}
?>