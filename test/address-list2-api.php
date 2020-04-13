<?php
require __DIR__. '/__connect_db.php';

$page_name = 'address-list2-api';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']):1;

//取得總筆數
$totalRows = $pdo->query("SELECT COUNT(1) FROM `address`")
    ->fetch(PDO::FETCH_NUM)[0];

//算總頁數
$totalPages = ceil($totalRows/$perPage);

//print_r($totalRows);

($page<1) ? ($page=1) : false;
($page>$totalPages) ? ($page=$totalPages) : false;



//exit;
$sql = sprintf("SELECT * FROM `address` ORDER BY `sid` DESC LIMIT %s, %s",($page - 1) * $perPage, $perPage);

$stmt = $pdo->query($sql);


$output = [
    'page' => $page,
    'perPage' => $perPage,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'rows' => $stmt->fetchAll(),
];
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);

