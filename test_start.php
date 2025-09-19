<?php
include 'session.php';
$username=$_SESSION['username'];
$fullname=$_SESSION['fullname'];
$level=$_SESSION['level'];	
$photo=$_SESSION['photo'];
//include("database.php");
include 'dconn.php';
$testid=$_GET['testid'];
$qry1 = "SELECT * FROM cf_test WHERE test_id LIKE ?";
$abs1 = $pdo->prepare($qry1);
$abs1->execute(array($testid));
$abs1->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $abs1->fetch()) {
$init=$row['timemi'];
$hour=floor(($init / 60)%60);
$minute=floor(($init)%60);
$sec=($init * 60)%60;
}
$qry2 = "SELECT start , stop FROM cf_timer WHERE studentid LIKE ? AND testid LIKE ?";
$abs2 = $pdo->prepare($qry2);
$abs2->execute(array($username , $testid));
$fe=$abs2->fetchColumn();
if($fe)
{
$qry3 = "SELECT * FROM cf_timer WHERE studentid LIKE ? AND testid LIKE ?";
$abs3 = $pdo->prepare($qry3);
$abs3->execute(array($username , $testid));
$abs3->setFetchMode(PDO::FETCH_ASSOC);
while ($r13 = $abs3->fetch()) {
$spent=($r13['spentold'])/60;
}		
		$qry4 = "UPDATE cf_timer SET start=NOW() WHERE studentid LIKE ? AND testid LIKE ?";
		$abs4 = $pdo->prepare($qry4);
		$abs4->execute(array($username , $testid));
		$actual = ($init - $spent) ;
		$hour=floor(($actual / 60)%60);
		$minute=floor(($actual)%60);
		$sec=($actual * 60)%60;
}else{
		$qry5 = "INSERT INTO cf_timer(studentid , testid , start , spent , spentold) VALUES(?, ?, NOW(), ?, ?)";
    	$abs5 = $pdo->prepare($qry5);
    	$abs5->execute(array($username , $testid , '0' , '0'));
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
<script type="text/javascript">
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
	$(document).ready(function(){
		$(document).on("keydown", disableF5);
});
</script>
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
                  <h4 class="page-header"><b>NAME:</b>  <?php echo ucwords($fullname) ; ?>  | <b>CLASS: </b>  <?php echo strtoupper($level) ; ?>  | <b>LOGIN ID: </b>  <?php echo strtoupper($username) ; ?> </h4> 
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div align="left"> Time Left:
	<button type="button" class="btn btn-danger">
    <div class="clock">
    			<span style="color:white;" class="hou"><?php echo $hour; ?></span> : <span style="color:white;" class="min"><?php echo $minute; ?></span> : <span style="color:white;" class="sec"><?php echo $sec; ?></span> </div> </button> (H:M:S)
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
$qry6 = "SELECT * FROM cf_question WHERE test_id LIKE ? ORDER BY rand() limit $questno";
$abs6 = $pdo->prepare($qry6);
$abs6->execute(array($testid));
$numrows=$abs6->rowCount();
?>
<script type="text/javascript">
var totalq = <?php echo $numrows; ?>
    
function countdown(){
		var h = $('.hou');
		var m = $('.min');
		var s = $('.sec');
		if(h.html()<=0 && parseInt(m.html())<=0 && parseInt(s.html()) <= 0){
			$('.clock').html('Your Time is UP, Submit now.');
			$('#questions').hide();
			$('.nextq').hide();
			$('.prev').hide();
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
										$('#questions').text("YOUR TIME IS FINISHED AND YOUR TEST/EXAM HAS BEEN SUBMITTED, YOU WILL BE AUTO LOGOUT NOW!")
										var delay = 6000;
										 setTimeout((function(){ window.location = 'dashboard.php'  }), delay);
										}
								}
							});
			
			
		}
		if(parseInt(m.html()) <0 ){
			h.html(parseInt(h.html()-1));
			m.html(59);
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