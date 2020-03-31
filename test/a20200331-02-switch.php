<?php
$s = isset($_GET['s']) ? intval($_GET['s']) : 0;
?>

<form action="" method="get">
    <input type="text" name="s" value="<?php echo $s ?>">
    <input type="submit">
</form>

<?php
$ss = intval($s/10);
switch($ss){
    case 10:
    case 9:
        $g = 'A';
    break;
    case 8:
        $g = 'B';
    break;
    case 7:
        $g = 'C';
    break;
    case 6:
        $g = 'D';
    break;
    default:
        $g = 'F';
    break;

}


echo $g
?>