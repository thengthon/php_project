<?php 
    // destroy all session to clear USERNAME then logout
    session_start();
    session_destroy();
    header("Location: http://localhost/php_project/");
?>