<?php
/*
##################################### CBTflux ###########################################################
## This CBT software [ CBTflux ] was developed by FLUXTECH CONCEPTS.								   ##
## You are NOT authorized to COPY or MODIFY this code without a written approval					   ##
## from Engr. Kunle Olatunji (olatunjiaa@yahoo.com). CEO, FLUXTECH CONCEPTS.						   ##
##																									   ##
## FLUXTECH CONCEPTS																				   ##
## 08068782879																						   ##
## No 20, 2nd Floor, Adjacent Ostrich Bakery, Ajegunle Street, Olonkoro, Osogbo, Osun State, Nigeria.  ##
## fluxtech@fluxtechng.com																			   ##
## www.fluxtechng.com																				   ##
#########################################################################################################
*/
date_default_timezone_set('Africa/Lagos');
session_start();
$error_reg='';
if(isset($_POST['login'])){
if(empty($_POST['username'])
|| empty($_POST['password'])
|| empty($_POST['seckey'])){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>All Fields must be filled</div>";
}
else
{
$username = $_POST['username'];
$password = $_POST['password'];
$seckey = $_POST['seckey'];
$username = htmlspecialchars(trim($username));
$password = htmlspecialchars(trim($password));
$seckey = htmlspecialchars(trim($seckey));
$password = md5($password);
$seckey = sha1($seckey);
include 'dconn.php';		
	$chk = 'SELECT loginid FROM cf_admin WHERE loginid LIKE ?';
    $ch = $pdo->prepare($chk);
    $ch->execute(array($username));
	$fe = $ch->fetchColumn();
	if(!$fe)
	{
	$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Invalid Username</div>";
	}else{
	$chk = 'SELECT loginid FROM cf_admin WHERE loginid LIKE ? AND password LIKE ?';
    $ch = $pdo->prepare($chk);
    $ch->execute(array($username , $password));
	$fe = $ch->fetchColumn();
	if(!$fe)
	{
	$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Invalid Password</div>";
	}else{
	$chk = 'SELECT loginid FROM cf_admin WHERE loginid LIKE ? AND password LIKE ? AND security LIKE ?';
    $ch = $pdo->prepare($chk);
    $ch->execute(array($username , $password , $seckey));
	$fe = $ch->fetchColumn();
	if(!$fe)
	{
	$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Invalid Security Key</div>";
	}else{
		$_SESSION['loginid']=$username;	
	$sql4 = 'UPDATE cf_admin SET logintime=NOW() , status=? WHERE loginid LIKE ?';
    $q4 = $pdo->prepare($sql4);
    $q4->execute(array('ONLINE' , $username));
	header("location: dashboard.php"); 
}}}
$pdo = null;
}}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | CBTflux</title>
    <!-- Core CSS - Include with every page -->
    <?php include '../assets/plugins/bootstrap/bootstrap2.php' ; ?>
    <?php include '../assets/plugins/bootstrap/assets2.php' ; ?>
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="../assets/css/style.css" rel="stylesheet" />
      <link href="../assets/css/main-style.css" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              
                </div>
            <div class="col-md-4 col-md-offset-4">
            <img src="../assets/img/logo.png" alt=""/><b><?php echo $_SESSION['fedition'] ; ?></b> 
                <div class="login-panel panel panel-default">                 
                    <div class="panel-heading">
                        <h3 class="panel-title">Administrator Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                            <?php echo $error_reg ; ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Security Key" name="seckey" type="password" value="">
                                </div>
                                <input name="login" type="submit" class="btn btn-success" value=" Login ">
                            </fieldset>
                            <br><a href="../index.php"><i class="fa fa-arrow-left"></i> Back to Homepage</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
