<?php

    function get_db() {
        return new mysqli('localhost', 'root', '', 'php_project');
    }

    function get_ministries() {
        return get_db()->query('SELECT ministry.*, minister.* FROM ministry JOIN minister USING (ministerID)');
    }

    
?>