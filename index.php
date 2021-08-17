<?php

    include_once('partial/header.php');
    include_once('partial/navbar.php');

    // if (isset($_GET['page'])) {
    //     $isPageExist = file_exists('pages/' . $_GET['page'] . '.php');
    //     $page = 'pages/' . $_GET['page'] . '.php';
    //     if($isPageExist) {
    //         include_once($page);
    //     }else {
    //         include_once('pages/404.php');
    //     }
    // }else {
    //     include_once('pages/home.php');
    // }
    include_once('pages/home.php');
    include_once('pages/ministry.php');
    include_once('pages/news.php');
    include_once('pages/donate.php');

    include_once('partial/footer.php');

?>