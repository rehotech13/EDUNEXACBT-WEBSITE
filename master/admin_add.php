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
include 'session.php';
include 'dconn.php';
if(isset($_POST['add'])){
if(empty($_POST['userna'])
|| empty($_POST['password']) 
|| empty($_POST['cpassword'])
|| empty($_POST['security'])
|| empty($_POST['csecurity'])){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>All fields are compulsory</div>";
}
elseif(strlen($_POST['password']) < 6 ){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password must be minimum of 6 characters</div>";
}
elseif($_POST['password']!=$_POST['cpassword']){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password and Confirm Password not match</div>";
}
elseif($_POST['security']!=$_POST['csecurity']){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Security Key and Confirm Security Key not match</div>";
}
else
{
$userna = $_POST['userna'];
$password = $_POST['password'];
$security = $_POST['security'];
$userna = htmlspecialchars(trim($userna));
$password = htmlspecialchars(trim($password));
$security = htmlspecialchars(trim($security));
$password = md5($password);
$security = sha1($security);
	$sql = 'SELECT loginid FROM cf_admin WHERE loginid LIKE ?';
    $ch = $pdo->prepare($sql);
    $ch->execute(array($userna));
	$fe = $ch->fetchColumn();
	if($fe)
	{
	$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Login ID already exist, choose another Login ID</div>";
	}else{
	$sql2 = "INSERT INTO cf_admin(loginid , password , security , status) VALUES(?, ?, ?, ?)";
    $q = $pdo->prepare($sql2);
    $q->execute(array($userna , $password , $security , 'OFFLINE'));
	if($q){
$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>New Admin, ( $userna ) Added successfully.</div>";
header("location: admins.php");
     }else{
$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to add new user, try again later</div>";
header("location: admins.php");
            }}}
$pdo = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin ::: CBTflux</title>
    <!-- Core CSS - Include with every page -->
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="../assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">
                    <img src="../assets/img/logo.png" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->

            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <img src="../assets/img/edelogo.jpg" width="55" height="60"/>
                            </div>
                            <div class="user-info">
                            <div class="user-text-online">
                                <?php echo strtoupper($_SESSION['loginid']); ?><br>
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    <?php include 'menuapp.php' ;?>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h4 class="page-header">Add New Admin</h4>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->

                
                <div class="panel panel-default">
                        <div class="panel-heading">
                            New Admin Creation
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="post">
                                    <?php echo $error_reg ; ?>
                                    <div class="form-group">
                                            <label>Login ID</label>
                                            <input class="form-control" name="userna" type="text">
                                    </div>
                                    <div class="form-group">
                                            <label>Password</label> <i> (minimum of 6)</i>
                                            <input class="form-control" name="password" type="password" minlength="6">
                                    </div>
                                    <div class="form-group">
                                            <label>Confirm Password</label> <i> (minimum of 6)</i>
                                            <input class="form-control" name="cpassword" type="password" minlength="6">
                                    </div>
                                    <div class="form-group">
                                            <label>Security Key</label> <i> (numbers only)</i>
                                            <input class="form-control" name="security" type="password">
                                    </div>
                                    <div class="form-group">
                                            <label>Confirm Security Key</label> <i> (numbers only)</i>
                                            <input class="form-control" name="csecurity" type="password">
                                    </div>
                                    <input name="add" type="submit" class="btn btn-success" value=" Add Admin ">
                                    </form><br>
                                </div>
                               
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- end page-wrapper -->
<?php include '../footer.php' ; ?>
    </div>
    
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/plugins/pace/pace.js"></script>
    <script src="../assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="../assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/plugins/morris/morris.js"></script>
    <script src="../assets/scripts/dashboard-demo.js"></script>

</body>
</html>