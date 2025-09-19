<?php
session_start();
/*
##################################### CBTflux ###########################################################
## This CBT software [ CBTflux ] was developed by FLUXTECH CONCEPTS.								   ##
## You are NOT authorized to COPY or MODIFY this code without a written approval					   ##
## from Engr. Kunle Olatunji (olatunjiaa@yahoo.com). CEO, FLUXTECH CONCEPTS.						   ##
##																									   ##
## FLUXTECH CONCEPTS																				   ##
## 08068782879																						   ##
## No 20, 2nd Floor, Adjacent Ostrich Bakery, Ajegunle Street, Olonkoro, Osogbo, Osun State, Nigeria.  ##
## info@fluxtechng.com																			   ##
## www.fluxtechng.com																				   ##
#########################################################################################################
*/
include '../dconn.php';
	if($db)
	{
header("location: ../index.php");
	}else{
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation  |  CBTflux</title>
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
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <div class="navbar-header">
                <a class="navbar-brand">
                    <img src="../assets/img/logo.png" alt="" />
                </a>
            </div>
        </nav>
		<div class="col-lg-12">
                            <div class="container">
        <div class="row"><br><br>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">CBTflux Installation</h3>
                    </div>
                    <div class="panel-body">
                    This CBT software (CBTflux) was developed by <b>FLUXTECH CONCEPTS NIGERIA</b><br>
                    Phone: <b>+2348068782879</b> | Email: <b>info@fluxtechng.com OR olatunjiaa@gmail.com</b> |  Website: <b>www.fluxtechng.com</b><br>
                    <i>You are NOT permitted to copy, distribute or modify this software in anyway without a written permission from Engr Kunle Olatunji, CEO, FLUXTECH CONCEPTS. Violator shall be dealt with in accordance with the international copyright law.</i>
                    
                    <h1>Installation compatibility</h1>
<p>Before proceeding with the full installation, CBTflux will carry out some tests on your server configuration and files to ensure that you are able to install and run CBTflux. Please ensure you read through the results thoroughly and do not proceed until all the required tests are passed. If you wish to use all the features in this CBT software, you should ensure that these tests are passed.<br /> <br />
If your server failed in any test then you are unable to proceed. CBTflux hardly recommend that your server will pass in all tests. If you have any problem then contact to <a href="http://fluxtechng.com">FLUXTECH CONCEPTS Team</a> or <a href="mailto:olatunjiaa@gmail.com">Mail to our Support Team.</a></p>
<br>
<table width="100%" border="1" style="border-collapse:collapse;">
  <tr>
    <td width="44%">&nbsp;PHP version &gt;=5.0</td>
    <td width="56%"><?php if (strnatcmp(phpversion(),'5.0.0') >= 0)
    {
    echo "<font color='green'>&nbsp;Yes ". phpversion(). "</font>";
	$phpver=1;
    } 
	else
	{
		echo "<font color='#FF0000'>&nbsp;No</font>";
		$phpver=0;
	}
	?></td>
  </tr>
</table><br>
<span style="text-align:justify;">  </span>
<p align="center">
<input class="btn btn-success" type="button" name="start" value="Proceed" onClick="parent.location='step2.php'">

</p>
                    </div>
                </div>
            </div>
                </div>
                    
                        <?php include '../footer.php' ; ?>
                    </div>
                </div>
        .
    </div>
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