<?php

    include_once('partial/header.php');
    
    if (isset($_GET['page']) && isset($_GET['s'])) {
        include_once('partial/navbar_admin.php');
        include_once('pages/admin/activation.php');
        include_once('pages/admin/news_crud.php');
        include_once('pages/admin/minister_crud.php');
        include_once('pages/admin/ministry_crud.php');
        include_once('pages/admin/user_crud.php');
        include_once('partial/sub_footer.php');
    } else {
        if (isset($_GET['page'])) {
            $isPageExist = file_exists('pages/' . $_GET['page'] . '.php');
            $page = 'pages/' . $_GET['page'] . '.php';
            if($isPageExist) {
                require_once($page);
            }else {
                require_once('pages/404.php');
            }
        } else {
            if (isset($_GET['s'])) {
                include_once('partial/navbar_admin_switch.php');
            } else {
                include_once('partial/navbar.php');
            }
            include_once('pages/user/home.php');
            include_once('partial/sub_footer.php');
        }
    }

    include_once('partial/footer.php');

?>