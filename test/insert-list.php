<?php
require __DIR__. '/__connect_db.php';

$page_name = 'data-insert';

if(isset($_POST['Name']) and isset($_POST['Phone'])) {

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
        $success = true;
    } else {
        $success = false;
    }

}


?>
<?php include __DIR__.'/tearaside/head.php'; ?>
<?php include __DIR__.'/tearaside/boostrap.php'; ?>
<div class="container">
    <?php if(isset($success)):  ?>
        <?php if($success):  ?>
            <div class="alert alert-success" role="alert">
                資料新增成功
            </div>
        <?php else:  ?>
            <div class="alert alert-danger" role="alert">
                資料新增失敗
            </div>
        <?php endif;  ?>
    <?php endif;  ?>
    <div class="row">
        <div class="col-lg-6">
            <form method="post">
                <div class="form-group">
                    <label for="Name">Name</label >
                    <input type="text" class="form-control" id="Name" name="Name" required 
                    value="<?= isset($_POST['Name']) ? htmlentities($_POST['Name']) : '' ?>" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" 
                    value="<?= isset($_POST['Email']) ? htmlentities($_POST['Email']) : '' ?>" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input type="text" class="form-control" id="Phone" name="Phone" pattern="09\d{2}-?\d{3}-?\d{3}" required value="<?= isset($_POST['Phone']) ? htmlentities($_POST['Phone']) : '' ?>" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="Birthday">Birthday</label>
                    <input type="date" class="form-control" id="Birthday" name="Birthday" 
                    value="<?= isset($_POST['Birthday']) ? htmlentities($_POST['Birthday']) : '' ?>" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <textarea class="form-control" id="Address" name="Address" aria-describedby="emailHelp"
                    ><?= isset($_POST['address']) ? htmlentities($_POST['address']) : '' ?></textarea>
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__.'/tearaside/footer.php'; ?>
