<?php
include 'dconn.php';
$sq = 'SELECT fullname , username , password , gender FROM cf_users limit 3';
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
header('Content-Disposition: attachment; filename=Bulk_Users_Format.csv');
fclose($fp);
?>