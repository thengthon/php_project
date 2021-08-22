<?php
    include_once('../database/db.php');
    if(isset($_POST)) {
        $name = $_POST['s-username'];
        $pwd = $_POST['s-password'];
        $email = $_POST['s-email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if(isset($_POST['action'])) {

                // go back to user page
                header("location: http://localhost/php_project/?page=signup&se=1");
            } else {

                // go back to admin page
                header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231&e=1#user");
            }
        } else if (!empty($name) && !empty($pwd)) {
            if (create_user($_POST)) {
                if(isset($_POST['action'])) {
                    header("location: http://localhost/php_project/?page=signup&se=2");
                } else {
                    header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231&e=2#user");
                }
            } else {
                if(isset($_POST['action'])) {
                    header("location: http://localhost/php_project/?page=signup&se=0");
                } else {
                    header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231&e=0#user");
                }
            }
        }
}
?>