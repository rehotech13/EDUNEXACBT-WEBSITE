<?php
session_start();
//include_once('database.php');
include 'dconn.php';
$qno= $_GET['qno'];
$testid=$_SESSION['testid'];
$qry7 = "SELECT * FROM cf_question WHERE test_id LIKE ? AND qno LIKE ? ORDER BY rand() limit 1";
$abs7 = $pdo->prepare($qry7);
$abs7->execute(array($testid , $qno));
$numrows = $abs7->rowCount();
$abs7->setFetchMode(PDO::FETCH_ASSOC);
while ($fetch = $abs7->fetch()) {
$_SESSION['qno']=$fetch['qno'];
$_SESSION['question']=htmlspecialchars_decode($fetch['question']);
$_SESSION['opt1']=$fetch['option1'];
$_SESSION['opt2']=$fetch['option2'];
$_SESSION['opt3']=$fetch['option3'];
$_SESSION['opt4']=$fetch['option4'];
$_SESSION['cor']=$fetch['correctanswer'];
}
$qry8 = "UPDATE cf_timer SET stop=NOW() WHERE studentid LIKE ? AND testid LIKE ?";
$abs8 = $pdo->prepare($qry8);
$abs8->execute(array($_SESSION['username'] , $testid));
$qry9 = "SELECT start , stop FROM cf_timer WHERE studentid LIKE ? AND testid LIKE ?";
$abs9 = $pdo->prepare($qry9);
$abs9->execute(array($_SESSION['username'] , $testid));
$abs9->setFetchMode(PDO::FETCH_ASSOC);
while ($ra1 = $abs9->fetch()) {
$start=strtotime($ra1['start']);
$stop=strtotime($ra1['stop']);
$diff=($stop - $start);
}
$qry10 = "UPDATE cf_timer SET spent=? WHERE studentid LIKE ? AND testid LIKE ?";
$abs10 = $pdo->prepare($qry10);
$abs10->execute(array($diff , $_SESSION['username'] , $testid));
echo "You have answered "."<b>".$_SESSION['num']."</b>"." questions out of "."<b>".$_SESSION['questno']."</b>"."";
$qry11 = "SELECT * FROM cf_testattempt WHERE stdid LIKE ? AND testid LIKE ? AND quid LIKE ?";
$abs11 = $pdo->prepare($qry11);
$abs11->execute(array($_SESSION['stdid'] , $_SESSION['testid'] , $qno));
$numrows2 = $abs11->rowCount();
$abs11->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $abs11->fetch()) {
if ($row['ans']===$_SESSION['opt1']){
$opt1="checked";
}
else{
	$opt1="";
	}	
	if ($row['ans']===$_SESSION['opt2']){
$opt2="checked";
}
else{
	$opt2="";
	}	
	if ($row['ans']===$_SESSION['opt3']){
$opt3="checked";
}
else{
	$opt3="";
	}
	if ($row['ans']===$_SESSION['opt4']){
$opt4="checked";
}
else{
	$opt4="";
	}
}
echo '<table class="table">
<tr><td>	
<div id="questions">  '.$_SESSION['question'].'<br><br>
</td></tr>
<tr><td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt1.' value="'.$_SESSION['opt1'].'" id="RadioGroup1_0" />
     '.$_SESSION['opt1'].' </label>
     </td></tr>
     <tr><td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt2.' value="'.$_SESSION['opt2'].'" id="RadioGroup1_1" />
     '.$_SESSION['opt2'].'</label></td></tr>
     <br />
     <tr> <td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt3.' value="'.$_SESSION['opt3'].'" id="RadioGroup1_2" />
        '.$_SESSION['opt3'].'</label></td></tr>
     <br /><tr><td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt4.' value="'.$_SESSION['opt4'].'" id="RadioGroup1_3" />
       '.$_SESSION['opt4'].'</label></td></tr>
     <br />
	    <input name="correct" type="hidden" id="qn3" value='.$_SESSION['cor'].' />
<tr><td>
</div>
</div>
</td></tr>
</table>
 '
?>
<script src="style/jquery/jquery-2.1.3.min.js" > </script>
<script type="text/javascript" src="style/jquery/jquery.countdown.pack.js"></script>
<script type="text/javascript">
jQuery("#RadioGroup1_0,#RadioGroup1_1,#RadioGroup1_2,#RadioGroup1_3").change(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"optionclick.php",
									data:formData,
									success: function(html){			
									if(html==0){
										return false;
										}else{
										}
								}
							});		
});
</script>