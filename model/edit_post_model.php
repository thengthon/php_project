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
        $title = $_POST['title'];
        $content = $_POST['content'];
        if (!empty($title) && !empty($content)) {
            update_post($_POST, $image_path);
        }
        header("location: http://localhost/php_project/?page=admin&s=1#news");
    }

?>