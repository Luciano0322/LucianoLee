<?php
require __DIR__. '/__connect_db.php';

// 回應的資料類型為 JSON
header('Content-Type: application/json');
// mime type 預設為 text/html
// jpg 檔的 mime type ?

// 讓 email 的內容不要重複
// UPDATE `address_book` SET `email`=CONCAT(ROUND(RAND()*100000),'@gmail.com')

$output = [
    'success' => false,
    'error' => '沒有 sid',
    'code' => 0,
    'postData' => $_POST
];
$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
// 如果沒有給 sid, 就回傳訊息然後結束

if (empty($sid)) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
// TODO: 欄位資料檢查\

 // 檢查 Email 是否重複
    $e_sql = "SELECT 1 FROM address WHERE email=?";
    $e_stmt = $pdo->prepare($e_sql);
    $e_stmt->execute([$_POST['Email'], $sid]);
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

    $sql = "UPDATE `address` SET `name`=?,`email`=?,`mobile`=?,`birthday`=?,`address`=? WHERE sid=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['Name'],
        $_POST['Phone'],
        $_POST['Email'],
        $_POST['Birthday'],
        $_POST['Address'],
        $sid
    ]);


    // echo $stmt->rowCount(); exit;

    if($stmt->rowCount()==1){
        $output['success'] = true;
        $output['error'] = '';
    } else {
        $output['error'] = '資料沒有修改';
    }

}

echo json_encode($output, JSON_UNESCAPED_UNICODE); 

