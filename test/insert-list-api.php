<?php
require __DIR__. '/__connect_db.php';

$output = [
    'success' => false,
    'error' => '欄位資料不足',
    'code' => 0,
];

if(isset($_POST['Name']) and isset($_POST['Phone'])) {
// TODO: 欄位資料檢查


    $sql = "INSERT INTO `address`(`name`, `phone`, `email`, `birthday`, `address`, `creat_at`) VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['Name'],
        $_POST['Email'],
        $_POST['Phone'],
        $_POST['Birthday'],
        $_POST['Address'],
    ]);


    // echo $stmt->rowCount(); exit;

    if($stmt->rowCount()==1){
        $output['success'] = true;
        $output['error'] = '';
    } else {
        $output['error'] = '資料無法新增';
    }

}

echo json_encode($output, JSON_UNESCAPED_UNICODE); 

