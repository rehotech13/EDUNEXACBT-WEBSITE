<?php		
ob_start();
include 'session.php';
include 'dconn.php';
$id = ($_GET["id"]);
$sq = 'DELETE FROM cf_admin WHERE id LIKE ?';
$q = $pdo->prepare($sq);
$q->execute(array($id));
if($sq){
$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Admin Deleted</div>";
header("location: admins.php");
}else{
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to delete Admin, try again later</div>";
header("location: admins.php");
}
?>