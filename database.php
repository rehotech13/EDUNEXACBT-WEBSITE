<?php
include('db.php');
$cn=mysql_connect("$host","$dbuser","$dbpass") or die("Could not Connect My Sql");
mysql_select_db("$db",$cn)  or die("Could connect to Database");
?>
