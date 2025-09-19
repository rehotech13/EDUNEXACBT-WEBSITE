<?php


if (isset($_POST['submit'])){
	if($_POST['chk'] == '')
	{
header("location: notchecked.php");
}else{header("location: checked.php");}}
?>
<form action="" method="post">
<input type="checkbox" name="chk"> Overide Existing Records?
<input type="submit" name="submit" value="Check" />
</form>