<?php
include 'session.php';
$username=$_SESSION['username'];
$fullname=$_SESSION['fullname'];
$level=$_SESSION['level'];	
$photo=$_SESSION['photo'];
include("database.php");
$testid=$_GET['testid'];
$qry=mysql_query("select * from cf_test where test_id='$testid'");
$numrows=mysql_num_rows($qry);
if ($numrows>0){
	$row=mysql_fetch_assoc($qry);
	$init=$row['timemi'];
	$minute=floor(($init)%60);
	$sec=($init * 60)%60;
}
include 'dconn.php';
$sql2 = 'SELECT start , stop FROM cf_timer WHERE studentid LIKE ? AND testid LIKE ?';
$q2 = $pdo->prepare($sql2);
$q2->execute(array($username , $testid));
$fe = $q2->fetchColumn();
if($fe)
{
		$qry=mysql_query("select * from cf_timer where studentid='$username' and testid='$testid'");
		$numrows=mysql_num_rows($qry);
		$row=mysql_fetch_assoc($qry);
		$spent=($row['spentold'])/60;
		$sql4 = 'UPDATE cf_timer SET start=NOW() WHERE studentid LIKE ? AND testid LIKE ?';
		$q4 = $pdo->prepare($sql4);
		$q4->execute(array($username , $testid));
		$actual = ($init - $spent) ;
		$minute=floor(($actual)%60);
		$sec=($actual * 60)%60;
}else{
		$sql2 = "INSERT INTO cf_timer(studentid , testid , start , spent , spentold) VALUES(?, ?, NOW(), ?, ?)";
    	$q = $pdo->prepare($sql2);
    	$q->execute(array($username , $testid , '0' , '0'));
}
$queno=$_SESSION['questno'];
$timemi=$_SESSION['timemi'];
$enable=$_SESSION['enable'];
$passmark=$_SESSION['passmark'];
$display=$_SESSION['userresult'];
$repeatable=$_SESSION['repeatable'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test In-progress ::: CBTflux</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="style/style.css" type="text/css" rel="stylesheet" />
    <link href="style/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <script src="style/jquery/jquery-2.1.3.min.js" > </script>
<script type="text/javascript" src="style/jquery/jquery.countdown.pack.js"></script>
<style type="text/css">
body {
	background-image: url(images/img02.png);
}
</style>
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
                <a class="navbar-brand" href="#">
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
                   </li>
                    <li class="selected">
                        <a href="#"><?php echo $_SESSION['fullname'] ; ?></a>
                    </li>
                    <li>
                        <a href="logsub.php"><i class="fa fa-lock fa-fw"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                  <h3 class="page-header"><b>NAME:</b>  <?php echo ucwords($fullname) ; ?>  | <b>CLASS: </b>  <?php echo strtoupper($level) ; ?>  | <b>LOGIN ID: </b>  <?php echo strtoupper($username) ; ?> </h3> 
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div align="center"> Time Left:
	<button type="button" class="btn btn-danger">
    <div class="clock">
    			<span style="color:white;" class="min"><?php echo $minute; ?></span> : <span style="color:white;" class="sec"><?php echo $sec; ?></span> </div> </button>
                        <div class="panel-body">
<body onload="test()">
<div class="row">
<div class="col-md-12">
<div align="left">
<table class=" table">
<tr><td> 
<div id="questions">  
</div>
<form action ="process_ans.php" name="form1" class="login" id="form1" >
<input name="qn" type="hidden" id="qn"/>
<input name="qnarray" type="hidden" id="qn1" />
<input name="qnarray2" type="hidden" id="qn2" />
<input  name="Preview" type="button" class="prev btn btn-primary" value="Previous" onclick="prev()" />
<input  name="next" type="Button" class="nextq btn btn-success" value="Next"    onclick="test()"/> 
<input  name="Submit" type="button" class="sub btn btn-danger" value="Submit" />
</form>
</td></tr>
</table>
</div>
</div>
<div class="col-md-1">
</div>
</div>
</div>
<?php
$questno = $_SESSION['questno']; 
$testid=$_SESSION['testid'];
//to count questions
$qry2=mysql_query("select * from cf_question where test_id=$testid order by rand() limit $questno",$cn) or die(mysql_error());
$numrows=mysql_num_rows($qry2);
?>
<script type="text/javascript">
var totalq = <?php echo $numrows; ?>
    
function countdown(){
		var m = $('.min');
		var s = $('.sec');
		if(m.html()<=0 && parseInt(s.html()) <= 0){
			$('.clock').html('Your Time is UP, Submit now.');
			$('#questions').hide();
			$('.nextq').hide();
			$('.prev').hide();	
			submittest();
		}
		if(parseInt(s.html()) <=0 ){
			m.html(parseInt(m.html()-1));
			s.html(60);
		}
		if(parseInt(s.html()) <=0){
			$('.clock').html('<span class="sec">59</span> seconds. ');
		}
		s.html(parseInt(s.html()-1));
}
		setInterval ('countdown()', 1000);
		
		
		
		var inc = -1;
		
				for (var i = 1, ar = []; i <= totalq; i++) {
    ar[i] = i;
  }
  ar.sort(function () {
      return Math.random() - 0.5;
  });

function test(){

  if(inc > totalq - 3){
  $('.nextq').fadeOut()
  }
  inc++;
$('#qn').val(inc);
$('#qn1').val(ar);
console.log(inc);
$('#qn2').val(ar[inc]); 
var qn= $('#qn2').val();
var cor =$('#qn3').val();
$(document).ready(function(e){
	 $('.prev').hide()
	var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"questions.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});	
									$.ajax({
									type:"POST",
									url:"process_ans.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{
										}
							}
						});	
jQuery(".nextq").click(function(e){
	 $('.prev').show()
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"questions.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{
											$('#questions').empty(html)
											$('#questions').append(html)
										}
								}
							});			
							
});
});
}

function prev(){

  if(inc < 2){
 $('.prev').fadeOut()
  }
  inc--;
$('#qn').val(inc);
$('#qn1').val(ar);
console.log(inc);
$('#qn2').val(ar[inc]); 
var qn= $('#qn2').val();
var cor =$('#qn3').val();
$(document).ready(function(e){
	
	var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"questions.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});
									$.ajax({
									type:"POST",
									url:"process_ans.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{	
										}
							}
						});	
jQuery(".prev").click(function(e){
	
								e.preventDefault();
								 $('.nextq').show()
								var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"questions.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});			
							
});
});
}
jQuery(".sub").click(function(e){
	$('.prev').hide()
	 $('.nextq').hide()
	  $('.sub').hide()
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"Submit.php",
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{
										$('#questions').fadeIn()
										$('#questions').text("YOUR TEST HAS BEEN SUBMITTED, YOU WILL BE LOGOUT NOW!")
										var delay = 3000;
										 setTimeout((function(){ window.location = 'dashboard.php'  }), delay);
										}
								}
							});			
							
});
</script>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'footer.php' ; ?>
    </div>
</body>
</html>