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
$id = ($_GET["testid"]);
$_SESSION['testid'] = $id;
include 'dconn.php';
	$sql1 = "SELECT * FROM cf_test WHERE test_id LIKE ?";
    $q = $pdo->prepare($sql1);
    $q->execute(array($id));
	$q->setFetchMode(PDO::FETCH_ASSOC);
	while ($r = $q->fetch()) {
	$name=($r['name']);
	$_SESSION['test'] = $name;
	$subid=($r['sub_id']);
	$questno=($r['questno']);
	$_SESSION['questno']=$questno;
	$timemi=($r['timemi']);
	$status=($r['enable']);
	$passmark=($r['passmark']);
	$_SESSION['passmark']=$passmark;
	$userresult=($r['userresult']);
	$_SESSION['userresult']=$userresult;
	$repeatable=($r['repeatable']);
	$_SESSION['repeatable']=$repeatable;
	}
	$sql3 = "SELECT * FROM cf_subjects WHERE sub_id LIKE ?";
    $q3 = $pdo->prepare($sql3);
    $q3->execute(array($subid));
	$q3->setFetchMode(PDO::FETCH_ASSOC);
	while ($r3 = $q3->fetch()) {
	$subcode=($r3['subcode']);
	$subtitle=($r3['subtitle']);
	$classes=($r3['class']);
	}
	if($repeatable == 'No'){
	$sql2 = "SELECT userid FROM cf_results WHERE userid LIKE ? AND test_id LIKE ?";
    $ch = $pdo->prepare($sql2);
    $ch->execute(array($username , $id));
	$fe = $ch->fetchColumn();
	if($fe)
	{
		$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You have already taken the Assessment, <a href='results.php'>click here to view your results</a></div>";
		header("location: dashboard.php");
    }else{
		}}else{}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test/Exam Details ::: CBTflux</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
   <script type="text/javascript">
	function deletevendor()
	{
		return confirm("Are you sure you want to Begin the Assessment?");
	}
		
</script>
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
                    <h4 class="page-header"><b>NAME:</b>  <?php echo ucwords($fullname) ; ?>  | <b>CLASS: </b>  <?php echo strtoupper($level) ; ?>  | <b>LOGIN ID: </b>  <?php echo strtoupper($username) ; ?> </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><center>Test/Exam Details, Please take note</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Test/Exam Name:</td>
                                    <td><?php echo $name ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Subject:</td>
                                    <td><?php echo $subcode ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Subject Title:</td>
                                    <td><?php echo $subtitle ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Class:</td>
                                    <td><?php echo $classes ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">No of Question:</td>
                                    <td><?php echo $questno ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Time:</td>
                                    <td><?php echo $timemi ; ?> minutes</td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Pass Mark Percentage:</td>
                                    <td><?php echo $passmark.'%' ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Display Result to User:</td>
                                    <td><?php echo $userresult ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Repeatable:</td>
                                    <td><?php echo $repeatable ; ?></td>
                                    </tr>
                                    <tr>
                                    <td align="right" style="font-weight:bold">Status:</td>
                                    <td><?php echo $status ; ?></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2" align="center"><a class="btn btn-success" href="test_start.php?testid=<?php echo $id; ?>" onClick="return deletevendor()">Begin Assessment</a></td>
                                    <tr>
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