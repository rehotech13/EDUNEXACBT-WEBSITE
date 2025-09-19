<?php
session_start();
$loginid = $_SESSION['username'];
error_reporting(1);
$time = date("h:i:s");
$date = date("l, F j, Y");
$tdate = $time.'  '.$date;
//include("database.php");
include 'dconn.php';
extract($_POST);
extract($_GET);
extract($_SESSION);
/*$rs=mysql_query("select * from mst_question where test_id=$tid",$cn) or die(mysql_error());
if($_SESSION[qn]>mysql_num_rows($rs))
{
unset($_SESSION[qn]);
exit;
}*/
if(isset($testid))
{
$_SESSION[tid]=$testid;

}
//if(!isset($_SESSION[sid]) || !isset($_SESSION[tid]))
//{
	//header("location: index.php");
//}
?>
	<?php



	
//			$sqladmin = mysql_query ("UPDATE studentreg SET status = 'done' WHERE id = '$loginid'");
$mark=$_SESSION['mark'];
$passmark=$_SESSION['passmark'];
$display=$_SESSION['userresult'];
$repeatable=$_SESSION['repeatable'];
$siql2 = "INSERT INTO cf_results(userid , test_id , score , mark , passmark , display , repeatable , testdate) VALUES(?, ?, ?, ?, ?, ?, ?, NOW())";
$ssqsw = $pdo->prepare($siql2);
$ssqsw->execute(array($username , $tid , $_SESSION['trueans'] , $mark , $passmark , $display , $repeatable));
	$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You have completed your Assessment, <a href='results.php'>click here to view your results</a></div>";		
?>					
				<script type="text/javascript">
				
					window.location='dashboard.php';
				</script>
				