<?php
    $mes = '';
    if(isset($_GET['se'])) {
        if($_GET['se'] == 1) {
            $mes = 'Try again, invalid data or format';
        } else if ($_GET['se'] == 0) {
            header("location: http://localhost/php_project/?page=login&mes=1");
        } else if ($_GET['se'] == 2) {
            $mes = 'Try again, user is existed!';
        }
    }
?>
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="w-50 m-auto text-center border border-danger p-5">
        <img src="pictures/logo3.png" alt="LOGO" id="l-logo">
        <div>
            <form action="authentication/signup_model.php" method="POST" class="p-3">
                <input type="hidden" value="signup" name="action">
                <div class="form-group">
                    <input type="text" class="form-control" name="s-username" placeholder="Username/ឈ្មោះ"​ autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="s-password" placeholder="Password/លេខសម្ងាត់" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="s-email" placeholder="Email/អ៊ីម៉ែល" autocomplete="off">
                </div>
                <span class="text-danger mb-3"><?= $mes ?></span>
                <div class="text-right">
                    <a href="http://localhost/php_project"​ class="btn btn-warning">ត្រឡប់</a>
                    <button type="submit" class="btn btn-primary">ចុះឈ្មោះ</button>
                </div>
            </form>
        </div>
    </div>
</div>
