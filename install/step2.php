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
## info@fluxtechng.com OR olatunjiaa@gmail.com																			   ##
## www.fluxtechng.com																				   ##
#########################################################################################################
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Step 2 |  CBTflux</title>
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
                        <h3 class="panel-title">Step 2 | CBTflux Installation</h3>
                    </div>
                    <div class="panel-body">
                    
                    <h1>DataBase Configuration</h1>
<center>

</center>
<p><font color='#FF0000'>Be careful and check twice before proceed. Your DataBase server will mostly be <b>localhost</b></font></p>
If your server connection passed, database will be created if not exists and tables populated, this may take some minutes, please wait untill you see the next step (Admin Creation).<br>
<br>
                            <center><?php
					if(!empty($_SESSION['error'])){
					echo $_SESSION['error'];
					unset($_SESSION['error']);
					}
					?></center>                        
<form name="database" action="instal.php" method="post">
<table width="100%" border="1" style="border-collapse:collapse;">
  <tr>
    <td width="44%">DataBase Server</td>
    <td width="56%">
      <input type="text" name="server" class="textbox" value="localhost" required />
      </td>
  </tr>
  <tr>
    <td>DataBase Name</td>
    <td>
      <input type="text" name="dbname" class="textbox" required /> <i>(small letters e.g. <b>cbtflux</b>)</i>
      </td>
  </tr>
  <tr>
    <td>DataBase Username</td>
    <td>
      <input type="text" name="db_user" class="textbox" required /> <i>(e.g. <b>root</b>)</i>
      </td>
  </tr>
  <tr>
    <td>DataBase Password</td>
    <td><input type="text" name="db_pass" class="textbox"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>
    <input class="btn btn-success" type="submit" name="submit" value="Next"></td>
    </tr>
</table>
</form>
<h1>&nbsp;</h1>
<span style="text-align:justify;">  </span>
<p align="center">
</p>
                    
                    This CBT software (CBTflux) was developed by <b>FLUXTECH CONCEPTS NIGERIA</b><br>
                    Phone: <b>+2348068782879</b> | Email: <b>info@fluxtechng.com OR olatunjiaa@gmail.com</b> |  Website: <b>www.fluxtechng.com</b><br>
                    <i>You are NOT permitted to copy, distribute or modify this software in anyway without a written permission from Engr Kunle Olatunji, CEO, FLUXTECH CONCEPTS. Violator shall be dealt with in accordance with the international copyright law.</i>
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