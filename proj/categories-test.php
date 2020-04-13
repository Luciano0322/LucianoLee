<?php
require __DIR__. '/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM categories");

//echo json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories-test</title>
</head>
<body>
    

<script>

let ori_cates = <?= json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE)?>;

</script>
</body>
</html>




