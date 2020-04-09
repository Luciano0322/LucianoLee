<?php
//啟動session
if(! isset($_SESSION)){
    session_start();
}
$users = [
    'Luciano' => [
        'nickname' => '新竹彭于晏',
        'pw' => '123',
    ],
    'John' => [
        'nickname' => '三重王陽明',
        'pw' => '456',
    ]
];

if(isset($_POST['account']) and isset($_POST['password'])){

    if(! empty($users[$_POST['account']])
        and 
        $users[$_POST['account']]['pw']===$_POST['password']){
        
        $_SESSION['loginUser'] = [
            'account' => $_POST['account'],
            'nickname' => $users[$_POST['account']]['nickname'],
        ];
    }

    // if($_POST['account'] == 'Luciano' and $_POST['password'] == '1234'){
    //     $_SESSION['loginUser'] = 'Luciano';
    // }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in</title>
</head>
<body>
<?php if(isset($_SESSION['loginUser'])):?>
    <div>
        <?= $_SESSION['loginUser']['nickname']?>,你好
    </div>
    <a href="a0406-logout.php">登出</a>
<?php else: ?>
    <form action="" method="post">
        <input type="text" name="account" placeholder="account"><br>
        <input type="password" name="password" placeholder="password"><br>
        <input type="submit"> 
    </form>
<?php endif; ?>
</body>
</html>