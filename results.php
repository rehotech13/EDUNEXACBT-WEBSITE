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
$sql2 = "SELECT userid FROM cf_results WHERE userid LIKE ?";
$q2 = $pdo->prepare($sql2);
$q2->execute(array($username));
$fe = $q2->fetchColumn();
if(!$fe)
{
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You have not taken any Assessment, <a href='dashboard.php'>click here to begin Assessment</a></div>";
}else{	
$sql1 = "SELECT * FROM cf_results WHERE userid LIKE ? AND display LIKE ?";
$q = $pdo->prepare($sql1);
$q->execute(array($username , 'Yes'));
$q->setFetchMode(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Results ::: CBTflux</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
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
                    <h4 class="page-header">Results</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Results of All Assessment
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            Results of Assessment by <b><?php echo strtoupper($fullname) ; ?></b>, of Class <b><?php echo strtoupper($level) ; ?></b> with Login ID <b><?php echo strtoupper($username) ; ?></b><br><br>
                            <?php echo $error_reg ;?>
                            <FONT COLOR="#cc0000"><i><b>Note:</b> If after taken a test and you do not see your result, it means the Test/Exam is set not to display result to user.</i></FONT><br><br>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Test/Exam Name</th>
                                            <th>Subject</th>
                                            <th>Score</th>
                                            <th>Percent</th>
                                            <th>Remark</th>
                                            <th>Date Taken</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
while ($ra = $q->fetch()) {
echo "<tr>";
	$sql3 = "SELECT t.name , s.subcode , s.subtitle FROM cf_test as t INNER JOIN cf_subjects as s WHERE t.sub_id=s.sub_id AND t.test_id LIKE ?";
    $q3 = $pdo->prepare($sql3);
    $q3->execute(array($ra['test_id']));
	$q3->setFetchMode(PDO::FETCH_ASSOC);
	while ($ra3 = $q3->fetch()) {
echo "<td>" . strtoupper($ra3['name']) . "</td>";
echo "<td>" . strtoupper($ra3['subcode']). ' ('.ucwords($ra3['subtitle']).')'."</td>";
	}
echo "<td>" . $ra['score'] . ' / '. $ra['tqu'] . "</td>";
$mar = ($ra['mark']);
echo "<td>" . $mar . '%'. "</td>";
if($ra['passmark'] > $mar)
{$remarks = 'FAILED';}else{$remarks = 'PASSED';}
echo "<td>" . $remarks. "</td>";
echo "<td>" . date('l d-M-Y, g:iA' , strtotime($ra['testdate']))."</td>";
echo "</tr>";
 }
?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
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