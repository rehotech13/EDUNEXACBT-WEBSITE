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

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Database Table ::: CBTflux</title>
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
                    <h4 class="page-header">Import Database Table</h4>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->

                
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Import Database Table
                        </div>
                        <div class="panel-body">
                                    <?php $error_reg; ?>
                                    <FONT COLOR="#cc0000" style="font-weight:bold"><u>WARNING</u><br>Be very careful, ensure you upload the correct file(.csv), once you click on Import Table, you can not abolished this operation.<br><br>
                                    
                                    If you select Overide Existing Records, all existing records in the chosen database Table will be deleted and replaced with this new records. However, if you do not select overide, it will add to existing records and you should be very carefull of duplicating the existing records as it may cause error.</FONT><br><br>
                            <?php
//Upload File
if (isset($_POST['submit'])){
$table = $_POST['table'];	
if($_POST['chk'] == '')
	{}else{
	$sq = "TRUNCATE TABLE ".$table."";
    $q = $pdo->query($sq);
	}
if (is_uploaded_file($_FILES['filename']['tmp_name'])){
echo "<h5>" . "File ". $_FILES['filename']['name'] ." sent to server." . "</h5>";
echo "<h5>Stay on this page untill you see 'Database Table ($table) imported successfully'</h5>";
//readfile($_FILES['filename']['tmp_name']);
}

//Import uploaded file to Database
$handle = fopen($_FILES['filename']['tmp_name'], "r");
$firstRow = true;
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
if($firstRow) {$firstRow = false;}
else{
if($table == 'cf_classes'){
	$sql2 = "INSERT INTO cf_classes(classes) VALUES(?)";
    $q2 = $pdo->prepare($sql2);
	$q2->execute(array($data[0]));}
elseif($table == 'cf_users'){
	$sql2 = "INSERT INTO cf_users(fullname , username , password , level , gender , status , logintime , logouttime) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q2 = $pdo->prepare($sql2);
	$q2->execute(array($data[0] , $data[1] , $data[2] , $data[3] , $data[4] , $data[5] , $data[6] , $data[7]));}
elseif($table == 'cf_subjects'){
	$sql2 = "INSERT INTO cf_subjects(subcode , subtitle , class) VALUES(?, ?, ?)";
    $q2 = $pdo->prepare($sql2);
	$q2->execute(array($data[0] , $data[1] , $data[2]));}
elseif($table == 'cf_test'){
	$sql2 = "INSERT INTO cf_test(name , sub_id , class , questno , timemi , enable , passmark , userresult , repeatable) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $q2 = $pdo->prepare($sql2);
	$q2->execute(array($data[0] , $data[1] , $data[2] , $data[3] , $data[4] , $data[5] , $data[6] , $data[7] , $data[8]));}
elseif($table == 'cf_question'){
	$sql2 = "INSERT INTO cf_question(test_id , qno , question ,  option1 , option2 , option3 , option4 , correctanswer) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $q2 = $pdo->prepare($sql2);
	$q2->execute(array($data[0] , $data[1] , $data[2] , $data[3] , $data[4] , $data[5] , $data[6] , $data[7]));}
else{
$sql2 = "INSERT INTO cf_results(userid , test_id , score ,  tqu , mark , passmark , display , repeatable , testdate) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $q2 = $pdo->prepare($sql2);
	$q2->execute(array($data[0] , $data[1] , $data[2] , $data[3] , $data[4] , $data[5] , $data[6] , $data[7] , $data[8]));}
}}
fclose($handle);
echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Database Table ($table) imported successfully</div>";
//view upload form
}else{
	
	print "<form enctype='multipart/form-data' action='' method='post'>";
	echo "<input type='checkbox' name='chk' value='check'> <label>Overide Existing Records in Database Table?</label>";
	print "<div class='form-group'>";
	print "<label>Database Table:</label>";
    print "<select class='form-control' name='table' required>";
    print "<option value=''>----Select Database Table----</options>";
	print "<option value='cf_classes'>Classes</options>";
	print "<option value='cf_users'>Users</options>";
	print "<option value='cf_subjects'>Subjects</options>";
	print "<option value='cf_test'>Test/Exams</options>";
	print "<option value='cf_question'>Questions</options>";
	print "<option value='cf_results'>Results</options>";
    print "</select>";
    print "</div>";
	print "<label>Select File to Import:</label>";
	print "<div class='form-group'>";
	print "<input class='form-control' type='file' name='filename' required>";
	print "</div>";
	print "<input class='btn btn-success' type='submit' name='submit' value='Import Database Table'></form>";
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