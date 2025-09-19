<?php
session_start();
if(isset($_POST['submit'])){
if(empty($_POST['server'])
|| empty($_POST['dbname'])
|| empty($_POST['db_user'])){
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>All fields are compulsory</div>";
header("location: step2.php");
}
else
{
$SERVER = $_POST['server'];
$db_name = $_POST['dbname'];
$USER = $_POST['db_user'];
$PASSWORD = $_POST['db_pass'];

$_dbx = new mysqli ($SERVER,$USER,$PASSWORD);
if ($_dbx->connect_error){
	$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to create database because connection could not be established to your server, ensured your server ( $SERVER ) is correct, and database username ( $USER ) and password have priviledge to your server and try again </div>";
header("location: step2.php");
	} else {
$database_sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if($_dbx->query($database_sql)===FALSE){
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to create database because connection could not be established to your server, ensured your server ( $SERVER ) is correct, and database username ( $USER ) and password have priviledge to your server and try again </div>";
header("location: step2.php");
//	return true;
	}
$string = '<?php 
$host = "'. $_POST["server"]. '";
$dbuser = "'. $_POST["db_user"]. '";
$dbpass = "'. $_POST["db_pass"]. '";
$db = "'. $_POST["dbname"]. '";
?>';
$fp = fopen("../db.php", "w");
fwrite($fp, $string);
$fp1 = fopen("../master/db.php", "w");
fwrite($fp1, $string);
fclose($fp);
fclose($fp1);
$con = mysqli_connect($SERVER, $USER, $PASSWORD, $db_name);
//$seldb = mysql_select_db($db_name, $con);
$table1='CREATE TABLE IF NOT EXISTS `cf_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `loginid` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `security` varchar(200) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `logintime` timestamp DEFAULT NULL,
  `logouttime` timestamp DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$create_tbl = $con->query($table1);

$table2='CREATE TABLE IF NOT EXISTS `cf_classes` (
  `class_id` int(10) NOT NULL AUTO_INCREMENT,
  `classes` varchar(100) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table2);
$table12='CREATE TABLE IF NOT EXISTS `cf_crp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fluxtech` varchar(17) DEFAULT NULL,
  `flink` varchar(25) DEFAULT NULL,
  `fedition` varchar(10) DEFAULT NULL,
  `fno` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table12);
$table3='CREATE TABLE IF NOT EXISTS `cf_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) DEFAULT NULL,
  `actdate` timestamp DEFAULT NULL,
  `actby` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table3);
$table4='CREATE TABLE IF NOT EXISTS `cf_promolog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `profrom` varchar(100) DEFAULT NULL,
  `proto` varchar(100) DEFAULT NULL,
  `prodate` timestamp DEFAULT NULL,
  `proby` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table4);
$table5='CREATE TABLE IF NOT EXISTS `cf_question` (
  `que_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(5) DEFAULT NULL,
  `qno` int(5) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correctanswer` varchar(255) NOT NULL,
  PRIMARY KEY (`que_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table5);
$table6='CREATE TABLE IF NOT EXISTS `cf_results` (
  `res_id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `test_id` int(5) DEFAULT NULL,
  `score` int(3) DEFAULT NULL,
  `tqu` int(5) DEFAULT NULL,
  `mark` int(3) DEFAULT NULL,
  `passmark` varchar(10) NOT NULL,
  `display` varchar(10) NOT NULL,
  `repeatable` varchar(5) DEFAULT NULL,
  `testdate` timestamp DEFAULT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table6);
$table7='CREATE TABLE IF NOT EXISTS `cf_subjects` (
  `sub_id` int(10) NOT NULL AUTO_INCREMENT,
  `subcode` varchar(20) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table7);
$table8='CREATE TABLE IF NOT EXISTS `cf_test` (
  `test_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `class` varchar(100) NOT NULL,
  `questno` varchar(10) NOT NULL,
  `timemi` varchar(10) NOT NULL,
  `enable` varchar(10) NOT NULL,
  `passmark` varchar(10) NOT NULL,
  `userresult` varchar(10) NOT NULL,
  `repeatable` varchar(10) NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table8);
$table9='CREATE TABLE IF NOT EXISTS `cf_testattempt` (
  `atid` int(11) NOT NULL AUTO_INCREMENT,
  `stdid` int(11) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `quid` int(11) DEFAULT NULL,
  `ans` varchar(255) DEFAULT NULL,
  `correctans` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`atid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table9);
$table10='CREATE TABLE IF NOT EXISTS `cf_timer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(50) DEFAULT NULL,
  `testid` int(5) DEFAULT NULL,
  `start` timestamp DEFAULT NULL,
  `stop` timestamp DEFAULT NULL,
  `spent` int(5) DEFAULT NULL,
  `spentold` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table10);
$table11='CREATE TABLE IF NOT EXISTS `cf_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `logintime` timestamp DEFAULT NULL,
  `logouttime` timestamp DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$create_tbl = $con->query($table11);
if($table1 and $table2 and $table3 and $table4 and $table5 and $table6 and $table7 and $table8 and $table9 and $table10 and $table11 and $table12){
$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Database Table populated successfully, create first admin now. </div>";
header("location: step3.php");
}else{
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Database created but unable to populate tables try again </div>";
header("location: step2.php");}}}}
?>
