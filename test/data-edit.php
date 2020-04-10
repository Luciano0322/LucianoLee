<?php
$page_name = 'data-edit';
require __DIR__ . '/__connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
// 如果沒有給 sid, 就轉到列表頁
if (empty($sid)) {
    header('Location: address-list.php');
    exit;
}

$sql = "SELECT * FROM address WHERE sid=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$sid]);
$r = $stmt->fetch();
// 如果沒有拿到資料
if (empty($r)) {
    header('Location: data-list.php');
    exit;
}


?>
<style>
.form-group small.form-text {
    color: red;
}
</style>
<?php include __DIR__.'/tearaside/head.php'; ?>
<?php include __DIR__.'/tearaside/boostrap.php'; ?>
<div class="container">
    <div id="info-bar" class="alert alert-success" role="alert" style="display: none">
            123
    </div>
    <div class="row">
        <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">修改資料</h5>
            <form name="form1" method="post" onsubmit="return checkForm()" novalidate>
            <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                <div class="form-group">
                    <label for="Name">* Name</label >
                    <input type="text" class="form-control" id="Name" name="Name" required 
                    value="<?= htmlentities($r['name']) ?>"                   aria-describedby="NameHelp">
                    <small id="NameHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" value="<?= htmlentities($r['email']) ?>" 
                    aria-describedby="EmailHelp">
                    <small id="EmailHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Phone">* Phone</label>
                    <input type="text" class="form-control" id="Phone" name="Phone" pattern="09\d{2}-?\d{3}-?\d{3}" required value="<?= htmlentities($r['phone']) ?>" aria-describedby="PhoneHelp">
                    <small id="PhoneHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Birthday">Birthday</label>
                    <input type="date" class="form-control" id="Birthday" name="Birthday" value="<?= htmlentities($r['birthday']) ?>" 
                    aria-describedby="BirthdayHelp">
                    <small id="BirthdayHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <textarea class="form-control" id="Address" name="Address" aria-describedby="AddressHelp"><?= htmlentities($r['address']) ?></textarea>
                    <small id="AddressHelp" class="form-text"></small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    const phone_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const 
        $name = $('#Name'),
        $email = $('#Email'),
        $phone = $('#Phone'),
        $nameHelp = $('#NameHelp'),
        $emailHelp = $('#EmailHelp'),
        $phoneHelp = $('#PhoneHelp')
        $info = $('#info-bar')

    function checkForm(){
        let isPass = true; // 有沒有通過檢查
        // 回復提示設定
        $('#info-bar').hide();
        $name.css('border-color', '#CCCCCC');
        $nameHelp.text('');

        $email.css('border-color', '#CCCCCC');
        $emailHelp.text('');

        $phone.css('border-color', '#CCCCCC');
        $phoneHelp.text('');

        if($name.val().length < 2){
            $name.css('border-color', 'red');
            $nameHelp.text('請填寫正確的姓名');
            isPass = false;
        }
        if($email.val()){
            if(! email_re.test($email.val())){
                $email.css('border-color', 'red');
                $emailHelp.text('請填寫正確的 Email 格式');
                isPass = false;
            }
        }
        if(! phone_re.test($phone.val())){
            $phone.css('border-color', 'red');
            $phoneHelp.text('請填寫正確的手機號碼');
            isPass = false;
        }

        if(isPass){
            $.post('data-edit-api.php', $(document.form1).serialize(), function(data){
                if(data.success){
                    $info.removeClass('alert-danger').addClass('alert-success');
                    $info.show().text('修改成功');
                } else {
                    $info.removeClass('alert-success').addClass('alert-danger');
                    $info.show().text(data.error);
                }
            }, 'json');
        }

        return false;
    }
</script>
<?php include __DIR__.'/tearaside/footer.php'; ?>
