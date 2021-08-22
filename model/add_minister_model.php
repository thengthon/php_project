<?php

    include_once('../database/db.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_FILES['image']['size'] > 0) {
            $upload_file = upload($_FILES['image']);
            if($upload_file) {
                $image_path = 'pictures/'.$upload_file;
            } else {
                $image_path = '';
                $mes = $_GET['mes'];
                echo "<script>alert($mes)</script>";
            }
        } else {
            $image_path = '';
        }
        $name = $_POST['name'];
        if (!empty($name)) {
            add_minister($_POST, $image_path);
        }
        header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231#minister");
    }

?>