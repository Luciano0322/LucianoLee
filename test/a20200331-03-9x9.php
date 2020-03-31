<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9x9</title>
</head>
<body>
    <table>
    <?php for($i=1; $i<=9; $i++): ?>
    <tr>
    <?php for($a=1; $a<=9; $a++): ?>
        <!-- <td><?= $i.'x'.$a.'='.$i*$a ?></td> -->
        <td><?= "$i x $a =".$i*$a ?></td>
        <?php endfor; ?>
    </tr>
        
    <?php endfor; ?>
    </table>
    
</body>
</html>