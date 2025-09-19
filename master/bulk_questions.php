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
$sel1 = 'SELECT test_id , name , class FROM cf_test';
$qsel1 = $pdo->query($sel1);
$qsel1->setFetchMode(PDO::FETCH_ASSOC);
while ($rsel1 = $qsel1->fetch()) {
$option.='<option value = "'.$rsel1['test_id'].'">'.$rsel1['name']. ' ('.$rsel1['class'].')'.'</option>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Questions ::: CBTflux</title>
    <!-- Core CSS - Include with every page -->
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                    <h4 class="page-header">Upload Bulk Questions</h4>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->

                
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Upload Bulk Questions
                        </div>
                        <div class="panel-body">
                                    <?php $error_reg; ?>
                                    <FONT COLOR="#cc0000" style="font-weight:bold"> Before you upload bulk questions, it is important that your questions follow a specific format in order to avoid error, please <a href="export/Bulk_Questions_Format.csv">click here to download bulk questions format</a> </FONT><br><br>
                            <?php
//Upload File
if (isset($_POST['submit'])){
//	$sq = 'TRUNCATE TABLE center';
//    $q = $pdo->query($sq);
if (is_uploaded_file($_FILES['filename']['tmp_name'])){
echo "<h5>" . "File ". $_FILES['filename']['name'] ." sent to server." . "</h5>";
echo "<h5>Stay on this page untill you see 'Bulk Questions uploaded successfully'</h5>";
//readfile($_FILES['filename']['tmp_name']);
}
$test = $_POST['test'];
//Import uploaded file to Database
$handle = fopen($_FILES['filename']['tmp_name'], "r");
$firstRow = true;
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
if($firstRow) {$firstRow = false;}
else{
	$sql2 = "INSERT INTO cf_question(test_id , qno , question , option1 , option2 , option3 , option4 , correctanswer) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q2 = $pdo->prepare($sql2);
	$q2->execute(array($test , $data[0] , $data[1] , $data[2] , $data[3] , $data[4] , $data[5] , $data[6]));
}}
fclose($handle);
echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bulk Questions uploaded successfully</div>";
//view upload form
}else{
	print "<b><u>WARNING</u><br>Be very careful, ensure you upload the correct file(.csv), once you click on Upload Questions, you can not abolished the operation.\n</b><br><br>";
	print "<form enctype='multipart/form-data' action='' method='post'>";
	print "<div class='form-group'>";
	print "<label>Test/Exam to upload questions to:</label>";
    print "<select class='form-control' name='test' required>";
    print "<option value=''>--Select Test/Exam--</options>";
	print "$option";
    print "</select>";
    print "</div>";
	print "<label>Select File to Upload:</label>";
	print "<div class='form-group'>";
	print "<input class='form-control' type='file' name='filename' required>";
	print "</div>";
	print "<input class='btn btn-success' type='submit' name='submit' value='Upload Questions'></form>";
}
?>
                            
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <script src="../assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
</body>
</html>