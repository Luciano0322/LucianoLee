<?php

require __DIR__ . '/__connect_db.php';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sql = "DELETE FROM `address` WHERE `sid`=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([ $sid  ]);
/*
echo json_encode([
    'rowCount' => $stmt->rowCount()
]);
*/

if(empty($_SERVER['HTTP_REFERER']))
    header('Location: address-list.php');
else
    header('Location: '. $_SERVER['HTTP_REFERER']);
