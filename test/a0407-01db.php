<?php

require __DIR__. '/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM address");

// $row = $stmt->fetch();

// print_r($row);

$row = $stmt->fetchAll();
echo json_encode($row);