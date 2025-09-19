<?php
include '../dconn.php';
$sq = 'SELECT fullname , username , password , level , gender , status , logintime , logouttime FROM cf_users';
$STH = $pdo->prepare($sq);
$STH->execute();
$fp = fopen('php://output', 'w');
$first_row = $STH->fetch(PDO::FETCH_ASSOC);
$headers = array_keys($first_row);
fputcsv($fp, $headers);
fputcsv($fp, array_values($first_row));
while ($row = $STH->fetch(PDO::FETCH_NUM))  {
fputcsv($fp,$row);
}
header('Content-Type: application/csv');
date_default_timezone_set('Africa/Lagos');
$apend = date('d_M_Y_g:iA');
header("Content-Disposition: attachment; filename=Users_$apend.csv");
fclose($fp);
?>