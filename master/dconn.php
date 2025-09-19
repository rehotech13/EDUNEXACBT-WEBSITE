<?php
include('db.php');
try{
$pdo = new PDO("mysql:host={$host};dbname={$db}",$dbuser,$dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}catch(PDOException $ex){ 
die($ex->getMessage());
}
?>