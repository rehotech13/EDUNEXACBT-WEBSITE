<?php
session_start();
$login_session=($_SESSION['username']) and ($_SESSION['level']);
if(!isset($login_session)){
header('Location: index.php');
}else{
}
?>