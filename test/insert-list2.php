<?php
require __DIR__. '/__connect_db.php';

$page_name = 'data-insert2';

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
            <form name="form1" method="post" onsubmit="return checkForm()" novalidate>
                <div class="form-group">
                    <label for="Name">* Name</label >
                    <input type="text" class="form-control" id="Name" name="Name" required 
                    aria-describedby="NameHelp">
                    <small id="NameHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" pattern="([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)" 
                    aria-describedby="EmailHelp">
                    <small id="EmailHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Phone">* Phone</label>
                    <input type="text" class="form-control" id="Phone" name="Phone" pattern="09\d{2}-?\d{3}-?\d{3}" required aria-describedby="PhoneHelp">
                    <small id="PhoneHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Birthday">Birthday</label>
                    <input type="date" class="form-control" id="Birthday" name="Birthday" 
                    aria-describedby="BirthdayHelp">
                    <small id="BirthdayHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <textarea class="form-control" id="Address" name="Address" aria-describedby="AddressHelp"></textarea>
                    <small id="AddressHelp" class="form-text"></small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
            $.post('data-insert-api.php', $(document.form1).serialize(), function(data){
                if(data.success){
                    $('#info-bar').show().text('新增成功');
                } else {

                }
            }, 'json');
        }

        return false;
    }
</script>
<?php include __DIR__.'/tearaside/footer.php'; ?>
