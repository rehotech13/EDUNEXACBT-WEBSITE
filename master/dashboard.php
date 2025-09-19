<?php
date_default_timezone_set('Africa/Lagos');
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
$loginid = strtoupper($_SESSION['loginid']);
	$sql = 'SELECT logintime , logouttime FROM cf_admin WHERE loginid LIKE ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['loginid']));
	$q->setFetchMode(PDO::FETCH_ASSOC);
    while ($ra = $q->fetch()) {
	$logintime = ($ra['logintime']);
	$logintime = date('l d-M-Y, g:iA' , strtotime($logintime));
	$logouttime = ($ra['logouttime']);
	$logouttime = date('l d-M-Y, g:iA' , strtotime($logouttime));
	}
	$app = 'SELECT loginid FROM cf_admin';
    $p = $pdo->query($app);
	$admi = $p->rowCount();
	$app2 = 'SELECT username FROM cf_users';
    $p2 = $pdo->query($app2);
	$use = $p2->rowCount();
	$app = 'SELECT question FROM cf_question';
    $p = $pdo->query($app);
	$ques = $p->rowCount();
	$app2 = 'SELECT name FROM cf_test';
    $p2 = $pdo->query($app2);
	$tes = $p2->rowCount();
$adm = 'SELECT loginid , status , logintime , logouttime FROM cf_admin';
$a = $pdo->query($adm);
$a->setFetchMode(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard ::: CBTflux</title>
    <!-- Core CSS - Include with every page -->
    <?php include '../assets/plugins/bootstrap/bootstrap2.php' ; ?>
    <?php include '../assets/plugins/bootstrap/assets2.php' ; ?>
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
                    <h4 class="page-header">Admin Dashboard</h4>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <b>Hello ! </b>Welcome Back <b><?php echo $loginid; ?>, (Administrator). </b>
                    </div>
                </div>
                <!--end  Welcome -->
                <div class="col-lg-6">
                    <div class="alert alert-warning text-center">
                        <i class="fa fa-lock fa-2x"></i><br><i>Login Time:</i> <b><?php echo $logintime;?> </b><br><i>Last seen:</i> <b><?php echo $logouttime;?> </b>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-info text-center">
                        <b><u>USERS STATISTICS</u></b><br>No of Admin: <b><?php echo $admi;?> </b><br>
                        No of Users: <b><?php echo $use;?> </b>
                         </b>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-info text-center">
                    <b><u>GENERAL STATISTICS</u></b><br>No of Questions: <b><?php echo $ques;?> </b><br>No of Test/Exam: <b><?php echo $tes;?> </b>
                        
                    </div>
                </div>
                
                                <div class="col-md-12">
                       <div class="panel panel-primary">
                        <div class="panel-heading">
                            ADMINS LOGIN ACTIVITIES
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Lastlogin</th>
                                            <th>Lastlogout</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
<?php
                                            while ($ad = $a->fetch()) {
											echo "<tr>";
											echo "<td>" .$ad['loginid']."</td>";
											echo "<td>" .date('l d-M-Y, g:iA' , strtotime($ad['logintime'])). "</td>";
											echo "<td>" .date('l d-M-Y, g:iA' , strtotime($ad['logouttime'])). "</td>";
											echo "<td>" .$ad['status']. "</td>";
											echo "</tr>";
											}
											?>             
                                    </tbody>
                                </table>
                            </div>
</div>
                        
                    </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                           <b>INFORMATION</b>
                        </div>
                        <div class="panel-body">
<i class="fa  fa-hand-o-right"></i><FONT COLOR="#cc0000"> Ensure you logout after your activities to prevent anybody from using your name as any activities you performed are being recorded in the database.</FONT><br><br>
<br>
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