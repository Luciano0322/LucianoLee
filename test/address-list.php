<?php
require __DIR__. '/__connect_db.php';

$page_name = 'address-list';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']):1;

//取得總筆數
$totalRows = $pdo->query("SELECT COUNT(1) FROM `address`")
    ->fetch(PDO::FETCH_NUM)[0];

//算總頁數
$totalPages = ceil($totalRows/$perPage);

//print_r($totalRows);

if($page<1 or $page>$totalPages){
    header('Location: address-list.php'); 
    exit;
}

//exit;
$sql = sprintf("SELECT * FROM `address` ORDER BY `sid` DESC LIMIT %s, %s",($page - 1) * $perPage, $perPage);

$stmt = $pdo->query($sql);

?>
<?php include __DIR__.'/tearaside/head.php'; ?>
<?php include __DIR__.'/tearaside/boostrap.php'; ?>
<div class="container">
    <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item <?= $page==1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page-1 ?>"><i class="fas fa-arrow-circle-left"></i></a>
        </li>
        <?php for($i=1; $i<=$totalPages; $i++): ?>
        <li class="page-item <?= $i===$page ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
        <?php endfor; ?>
        <li class="page-item <?= $page==$totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page+1 ?>"><i class="fas fa-arrow-circle-right"></i></a>
        </li>
    </ul>
    </nav>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Mobile</th>
            <th scope="col">Email</th>
            <th scope="col">Birthday</th>
            <th scope="col">Address</th>
        </tr>
        </thead>
        <tbody>
        <?php while($r=$stmt->fetch()): ?>
        <tr>
            <td><?= $r['sid'] ?></td>
            <td><?= $r['name'] ?></td>
            <td><?= $r['phone'] ?></td>
            <td><?= $r['email'] ?></td>
            <td><?= $r['birthday'] ?></td>
            <?php /*
                <td><?= strip_tags($r['address']) ?></td>
                */ ?>
                <td><?= htmlentities($r['address']) ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__.'/tearaside/footer.php'; ?>
