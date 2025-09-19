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
	$sql = 'SELECT fullname , username , level FROM cf_users ORDER BY username';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
	while ($r = $q->fetch()) {
		$option.='<option value = "'.$r['username'].'">'.$r['username']. ' ('.$r['fullname'].')'. ' '.$r['level'].'</option>';
}
if(isset($_POST['add'])){
if(empty($_POST['user'])){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Please select user</div>";
}
else
{

$target_dir = "usrimg/" ;
$target_file = $target_dir . basename( $_FILES["fileToUpload" ][ "name" ]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])){
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false){
$uploadOk = 1;
}else{
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Selected File is not an image, please select an image file.</div>";
$uploadOk = 0;
}
}
// Check if file already exists
if (file_exists($target_file)){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Sorry, file name already exists. Ensure you have saved your passport photograph with your Registration Number before upload.</div>";
$uploadOk = 0;
}
// Check file size
if($_FILES["fileToUpload"]["size"] > 50000) {
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Sorry, your passport photograph is too large. Must be less than 50Kb.</div>";
$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"){
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Sorry, only jpg, jpeg, png, JPG, JPEG, PNG files are allowed.</div>";
$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 ) {
// echo "Sorry, your file was not uploaded." ;
// if everything is ok, try to upload file
} else {
	$username=$_POST['user'];
	$username = htmlspecialchars(trim($username));
	function GetImageExtension($imagetype)
{
if (empty($imagetype)) return
false ;
 switch($imagetype)
 {
 case 'image/jpeg': return
'.jpeg';
 case 'image/jpg': return
'.jpg';
 case 'image/png': return
'.png';
 default: return false ;
}
 }
if (!empty($_FILES[ "fileToUpload" ][ "name" ])) {
$file_name=$_FILES[ "fileToUpload" ][ "name" ];
$temp_name=$_FILES[ "fileToUpload" ][ "tmp_name" ];
$imgtype=$_FILES[ "fileToUpload" ][ "type" ];
$ext= GetImageExtension($imgtype);
$imagename=$username.$ext;
$target_path = "usrimg/".$imagename;
if (move_uploaded_file($temp_name, $target_path)) {
	$sql2 = 'UPDATE cf_users SET photo=? WHERE username LIKE ?';
    $q = $pdo->prepare($sql2);
    $q->execute(array($target_path , $username));
if($q){
$error_reg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>$username passport photograph has been saved successfully.</div>";
}else{
$error_reg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Unable to upload Passport photograph now, try again later.</div>";
exit( "Error While uploading image on the server" );
}}}}}
$pdo = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Passport::: CBTflux</title>
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
                    <h4 class="page-header">Upload User Passport Phptograph</h4>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->

                
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Upload User Passport Phptograph
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="post" enctype= "multipart/form-data">
                                    <?php echo $error_reg ; ?>
                                    <div class="form-group">
                                <label>Users</label>
                                <select class="form-control" name="user" required>
                                   <option value="">----Select User----</options>
								   <?php echo $option;?>
                                </select>
                           		</div>
                                    <div class="form-group">
                                            <label>Passport Photo</label>
                                            <input class="form-control" name= "fileToUpload" type= "file" required>
                                    </div>
                                    <input name="add" type="submit" class="btn btn-success" value=" Upload Passport ">  <a class="btn btn-danger" href="users.php">Cancel</a> 
                                    </form><br>
                                </div>
                               <div class="col-lg-5">
                                <div class="alert alert-danger">
                                Maximum size: <b>100Kb</b><br>
                                Format: <b>jpg, jpeg, png</b><br>
                                Preferred Dimension: <b>100 X 120 pixel</b><br>
                                Maximum Dimension: <b>not exceeding 200 X 250 pixel</b>
                                </div>
                                </div>
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