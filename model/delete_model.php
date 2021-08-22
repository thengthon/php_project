<?php 
    if(isset($_GET['table']) && isset($_GET['id'])) {
        $table = $_GET['table'];
        $id = $_GET['id'];
        include_once('../database/db.php');
        echo delete($table, $id);
        header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231#$table");
    }