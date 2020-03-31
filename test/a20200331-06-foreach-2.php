<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>
<body>

<?php
    $ar1 = [
        'name' => 'Rose',
        'age' =>'25',
        'gender' =>'male',
        'id' =>'A88325',
    ];
    foreach($ar1 as $k => $v){
        echo "$k : $v <br>";
    }
?> 

</body>
</html>