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
$username=$_SESSION['username'];
$fullname=$_SESSION['fullname'];
$level=$_SESSION['level'];	
$photo=$_SESSION['photo'];
include 'dconn.php';
$sql1 = "SELECT t.test_id , t.name , t.sub_id , s.subcode , s.subtitle FROM cf_test as t INNER JOIN cf_subjects as s WHERE t.sub_id=s.sub_id AND t.class LIKE ? AND t.enable LIKE ?";
$q = $pdo->prepare($sql1);
$q->execute(array($level , 'Enabled'));
$q->setFetchMode(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard ::: CBTflux</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/user.jpg">
   </head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo.png" alt="" />
                </a>
            </div>
        </nav>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <div class="user-section">
                            <div class="user-info">
                            <?php echo "<img src=\"".$photo."\" width=\"140\" alt=\"Photo\" height=\"160\">"?>
                            <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                    <?php include 'menuapp.php' ;?>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">Dashboard</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <b>NAME:</b>  <?php echo strtoupper($fullname) ; ?><br>
                        <b>CLASS: </b>  <?php echo strtoupper($level) ; ?><br>
                        <b>LOGIN ID: </b>  <?php echo strtoupper($username) ; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-warning fa-1x"></i><br>Always remember to Logout after completing your test.
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Test/Exam(s) Available for you to take
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php
					if(!empty($_SESSION['success'])){
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					}
					if(!empty($_SESSION['error'])){
					echo $_SESSION['error'];
					unset($_SESSION['error']);
					}?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Test/Exam Name</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
while ($ra = $q->fetch()) {
echo "<tr>";
echo "<td>" . strtoupper($ra['name']) . "</td>";
echo "<td>" . strtoupper($ra['subcode']) . ' ('. ucwords($ra['subtitle']).')'."</td>";
?>
<td> <a href="test.php?testid=<?php echo $ra["test_id"]; ?>" class="btn btn-success btn-xm">Take Test/Exam</a></td>
<?php
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
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            INFORMATION
                        </div>
                        <div class="panel-body">
<i class="fa  fa-hand-o-right"></i><FONT COLOR="#cc0000"> Ensured you have finished your test/exam before you click on Submit button. Once you click Submit, your test/exam will be submitted and you may not be able to re-take the test.</FONT><br>
<br>
<i class="fa  fa-hand-o-right"></i><FONT COLOR="#cc0000"> If your time finished before you complete your Test/Exam, simply click on Submit button to submit your test/exam.</FONT><br>
<br>
<i class="fa  fa-hand-o-right"></i><FONT COLOR="#006600"> We wish you Good luck.</FONT><br><br>
<br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'footer.php' ; ?>
    </div>
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
</body>
</html>