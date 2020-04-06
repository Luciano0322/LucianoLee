<?php include __DIR__.'/tearaside/head.php'; ?>
<?php include __DIR__.'/tearaside/boostrap.php'; ?>
<div class="container">
    <pre>
        <?php
            print_r($_POST);
        ?>
    </pre>
<div class="row">
    <div class="col-lg-6">
        <form novalidate method="POST" action="">
            <div class="form-group">
                <label for="Email1">Email address</label>
                <input type="email" class="form-control" id="Email1" name="Email1">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="Password1">Password</label>
                <input type="password" class="form-control" id="Password1" name="Password1">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="Check1" name="Check1">
                <label class="form-check-label" for="Check1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>
<?php include __DIR__.'/tearaside/footer.php'; ?>
