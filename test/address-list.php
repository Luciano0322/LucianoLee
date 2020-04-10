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
<style>
    tbody tr i.fa-trash-alt {
        color: red;
    }
</style>
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
            <th scope="col"><i class="fas fa-trash-alt"></i></th>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Mobile</th>
            <th scope="col">Email</th>
            <th scope="col">Birthday</th>
            <th scope="col">Address</th>
            <th scope="col"><i class="fas fa-edit"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php while($r=$stmt->fetch()): ?>
        <tr>
            <!-- <td>
                <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                <i class="fas fa-trash-alt"></i>
                </a>
            </td> -->
            <td>
                <a class="del-link" href="data-delete.php?sid=<?= $r['sid'] ?>">
                <i class="fas fa-trash-alt"></i>
                </a>
             </td>
            <td><?= $r['sid'] ?></td>
            <td><?= $r['name'] ?></td>
            <td><?= $r['phone'] ?></td>
            <td><?= $r['email'] ?></td>
            <td><?= $r['birthday'] ?></td>
            <?php /*
                <td><?= strip_tags($r['address']) ?></td>
                */ ?>
                <td><?= htmlentities($r['address']) ?></td>
                <td><a href="data-edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a></td>
            
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
    // function delete_it(sid){
    //     if(confirm(`確定要刪除資料編號為 ${sid} 的項目嗎?`)){
    //         location.href = 'data-delete.php?sid=' + sid;
    //     }
    // }
    let delete_it = sid => {if(confirm(`確定要刪除資料編號為 ${sid} 的項目嗎?`)){
            location.href = 'data-delete.php?sid=' + sid;}
        }

    $('.del-link').click(function(event){
    console.log(this);
    console.log($(this));
    let sid = $(this).parent().next().text();
    if(! confirm(`確定要刪除資料編號為 ${sid} 的項目嗎?`)){
        event.preventDefault();
        }
    });
</script>
<?php include __DIR__.'/tearaside/footer.php'; ?>
