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
$loginid = $_SESSION['loginid'];
if(isset($_POST['save'])){
if(empty($_POST['old'])
|| empty($_POST['new']) 
|| empty($_POST['newsec'])){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Security Key field can not be left empty</div>";
}
elseif($_POST['new']!=$_POST['newsec']){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>New Security Key not matched, ensure New Security Key and Confirm New Security Key are the same</div>";
}
else
{
$old=$_POST['old'];
$new=$_POST['new'];
$old = htmlspecialchars(trim($old));
$new = htmlspecialchars(trim($new));
$olden = sha1($old);
$newen = sha1($new);
	$sql = 'SELECT security FROM cf_admin WHERE loginid LIKE ? AND security LIKE ?';
    $ch = $pdo->prepare($sql);
    $ch->execute(array($loginid , $olden));
	$fe = $ch->fetchColumn();
	if(!$fe)
	{
	$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Old Security Key not matched with the one in database</div>";
	}
	else
	{	
	$sql2 = 'UPDATE cf_admin SET security=? WHERE loginid LIKE ?';
    $q = $pdo->prepare($sql2);
    $q->execute(array($newen , $loginid));
	if($q)
	{
	$error_reg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Your security key has been changed successfully, keep it safe and do not give it out.</div>";
	}
	else
	{
	$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to change your security key, try again later</div>";
	}}
$pdo = null;
}}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Security Key | Admin ::: CBTflux</title>
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
                <a class="navbar-brand" href="index.php">
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
                                <img src="../assets/img/edelogo.jpg" alt="">
                            </div>
                            <div class="user-info">
                            <div class="user-text-online">
                                <?php echo $username ; ?><br>
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
                    <h4 class="page-header">Edit Security Key</h4>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Admin Security Key
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="post">
                                    <?php echo $error_reg ; ?>
                                    <div class="form-group">
                                            <label>Old Security Key</label>
                                            <input class="form-control" name="old" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Security Key</label> <i> (numbers only)</i>
                                            <input class="form-control" name="new" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm New Security Key</label> <i> (numbers only)</i>
                                            <input class="form-control" name="newsec" type="password">
                                        </div>
                                    <input name="save" type="submit" class="btn btn-success" value=" Edit Security Key ">
                                    </form><br>
                                </div>
                                <br><div class="col-lg-6"><div class="alert alert-info">Your Security Key must be different from your Password.<br>Use numbers only as your security key and keep it safe.</div></div>
                                
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