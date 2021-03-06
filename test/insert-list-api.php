<?php
require __DIR__. '/__connect_db.php';

// 回應的資料類型為 JSON
header('Content-Type: application/json');
// mime type 預設為 text/html
// jpg 檔的 mime type ?

$output = [
    'success' => false,
    'error' => '欄位資料不足',
    'code' => 0,
    'postData' => $_POST
];

if(isset($_POST['Name']) and isset($_POST['Phone'])) {
// TODO: 欄位資料檢查\

 // 檢查 Email 是否重複
    $e_sql = "SELECT 1 FROM address WHERE email=?";
    $e_stmt = $pdo->prepare($e_sql);
    $e_stmt->execute([$_POST['Email']]);
// echo $_POST['Email']; exit;
    if( $e_stmt->rowCount() ){
        $output['error'] = 'Email 重複了';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }


    // 檢查手機號碼格式
    $phone_re = "/^09\d{2}-?\d{3}-?\d{3}$/";
    if(empty(preg_grep($phone_re, [ $_POST['Phone']]))){
        $output['error'] = '手機號碼格式不符';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $sql = "INSERT INTO `address`(`name`, `phone`, `email`, `birthday`, `address`, `creat_at`) VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['Name'],
        $_POST['Phone'],
        $_POST['Email'],
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

