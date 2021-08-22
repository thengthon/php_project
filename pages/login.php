<?php
    $mes = '';
    if(isset($_GET['mes']) && $_GET['mes'] == 1) {
        $mes = 'You have created, please login!';
    }

    $user_error = '';
    $pwd_error = '';
    $invalid = 'Incorrect username or password...';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        include_once('database/db.php');

        if(empty($_POST['l-username'])) {
            $user_error = 'Please enter username...';
        }
        if(empty($_POST['l-password'])) {
            $pwd_error = 'Please enter password...';
        }
        if(empty($user_error) && empty($pwd_error)) {
            $get_user_login = login($_POST);
            if($get_user_login) {
                $role = $get_user_login['role'];
                if($role == 'admin') {
                    header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231");
                } else {
                    $_SESSION['user'] = $get_user_login['username'];
                    $_SESSION['userID'] = $get_user_login['userID'];
                    header("location: http://localhost/php_project");
                }
            } else {
                $mes = $invalid;
            }
        }
    }
?>
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="w-50 m-auto text-center border border-danger p-5">
        <img src="pictures/logo3.png" alt="LOGO" id="l-logo">
        <div>
            <form action="" method="POST" class="p-3">
                <div class="form-group">
                    <input type="text" class="form-control" id="l-username" name="l-username" placeholder="Username/ឈ្មោះ" autocomplete="off">
                    <span class="text-danger"><?= $user_error ?></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="l-password" name="l-password" placeholder="Password/លេខសម្ងាត់" autocomplete="off">
                    <span class="text-danger"><?= $pwd_error ?></span>
                </div>
                <span class="text-danger"><?= $mes ?></span>
                <div class="text-right">
                    <a href="http://localhost/php_project"​ class="btn btn-warning">ត្រឡប់</a>
                    <button type="submit" class="btn btn-primary">ចូល</button>
                </div>
            </form>
        </div>
    </div>
</div>
