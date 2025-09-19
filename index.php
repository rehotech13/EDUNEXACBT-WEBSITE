<?php
session_start();
/*
##################################### CBTflux ###########################################################
## This CBT software [ CBTflux ] was developed by FLUXTECH CONCEPTS.								   ##
## You are NOT authorized to COPY or MODIFY this code without a written approval					   ##
## from Engr. Kunle Olatunji (olatunjiaa@gmail.com). CEO, FLUXTECH CONCEPTS.						   ##
##																									   ##
## FLUXTECH CONCEPTS																				   ##
## 08068782879																						   ##
## No 20, 2nd Floor, Adjacent Ostrich Bakery, Ajegunle Street, Olonkoro, Osogbo, Osun State, Nigeria.  ##
## fluxtech@fluxtechng.com																			   ##
## www.fluxtechng.com																				   ##
#########################################################################################################
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delta State College of Nursing Sciences - CBTflux Portal</title>
    <!-- Core CSS - Include with every page -->
    <?php include 'assets/plugins/bootstrap/bootstrap.php' ?>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
   </head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo.png" alt="" />
                </a>
            </div>
        </nav>
		<div class="col-lg-12">
                    <div class="panel panel-default">                   
                        <div class="panel-body" style="background-image:url(assets/img/bg.jpg)">
                        
                            <p>
                       <br>                       
                        <div class="col-lg-7">
                    <br>
                    
                        <center><img src="assets/img/logo.jpg" class="img-responsive" height="200" width="200"/>
                        <h2 style="background-color:#FFF">Delta State College of Nursing Sciences</h2>
                        <b><h3><font style="background-color:#FFF"> (Computer Based Test)</h3></font></b>
<br><br><br><br><br><br><br><br><br>
                </div>
                    <div class="col-lg-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">User Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post">
                            <fieldset>
                            <?php
					if(!empty($_SESSION['error'])){
					echo $_SESSION['error'];
					unset($_SESSION['error']);
					}
					?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <input name="login" type="submit" class="btn btn-success" value=" Login ">
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
                </div>
                 </div>
                        <?php include 'footer.php' ; ?>
                    </div>
                </div>
        .
    </div>
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <?php include 'assets/plugins/bootstrap/assets.php' ; ?>
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
</body>
</html>