<?php

    function get_db() {
        return new mysqli('localhost', 'root', '', 'php_project');
    }

    function upload($my_file) {
        $img_name = $my_file['name'];
        $img_size = $my_file['size'];
        $tmp_name = $my_file['tmp_name'];
        $error = $my_file['error'];

        if($error === 0) {
            if($img_size > 500000) {
                $mes = "Try again, you file is too larg...";
                header("location: http://localhost/php_project/?page=admin&s=1&mes=$mes");
            } else {
                $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ext_lc = strtolower($img_ext);
                $allowed_ext = array('jpg', 'jpeg', 'png');
                if(in_array($img_ext_lc, $allowed_ext)) {
                    $new_img_name = uniqid("pic-", true).'.'.$img_ext_lc;
                    $img_upload_path = "../pictures/$new_img_name";
                    move_uploaded_file($tmp_name, $img_upload_path);
                    return $new_img_name;
                } else {
                    $mes = "Sorry, you can't upload this type of file...";
                    header("location: http://localhost/php_project/?page=admin&s=1&mes=$mes");
                }
            }
        } else {
            $mes = "Unknown error occured!";
            header("location: http://localhost/php_project/?page=admin&s=1&mes=$mes");
        }
    }
    
    // about post
    function get_news() {
        return get_db()->query('SELECT post.*, ministry.ministryName, user.username FROM post JOIN ministry USING (ministryID) JOIN user USING (userID) WHERE activated = 1 ORDER BY postID DESC');
    }
    
    function create_post($value, $image_path) {
        date_default_timezone_set('Asia/Phnom_Penh');
        $today = new DateTime();
        $date = $today->format("F j, Y, g:i a");
        $userID = 1;
        $title = $value['title'];
        $content = $value['content'];
        $photo = $image_path;
        $activated  = 1;
        if (empty($photo) && (!isset($value['ministryID']))) {
            get_db()->query("INSERT INTO post (date, userID, title, content, activated) VALUES ('$date', '$userID', '$title', '$content', '$activated');");
        } else if (empty($photo)) {
            $ministryID = $value['ministryID'];
            get_db()->query("INSERT INTO post (ministryID, date, userID, title, content, activated) VALUES ('$ministryID','$date', '$userID', '$title', '$content', '$activated');");
        } else if (!isset($value['ministryID'])) {
            get_db()->query("INSERT INTO post (date, userID, title, content, photo, activated) VALUES ('$date', '$userID', '$title', '$content', '$photo', '$activated');");
        } else {
            $ministryID = $value['ministryID'];
            get_db()->query("INSERT INTO post (ministryID, date, userID, title, content, photo, activated) VALUES ('$ministryID','$date', '$userID', '$title', '$content', '$photo', '$activated');");
        }
    }
    
    function get_edit_news($id) {
        return get_db()->query("SELECT * FROM post  WHERE postID = $id");
    }
    
    function update_post($value, $image_path) {
        date_default_timezone_set('Asia/Phnom_Penh');
        $today = new DateTime();
        $date = 'Edited, '.$today->format("F j, Y, g:i a");
        $title = $value['title'];
        $content = $value['content'];
        $photo = $image_path;
        $id = $value['id'];
        if (empty($photo) && (!isset($value['ministryID']))) {
            get_db()->query("UPDATE post SET date = '$date', title = '$title', content = '$content' WHERE postID = $id;");
        } else if (empty($photo)) {
            $ministryID = $value['ministryID'];
            get_db()->query("UPDATE post SET ministryID = '$ministryID', date = '$date', title = '$title', content = '$content' WHERE postID = $id;");
        } else if (!isset($value['ministryID'])) {
            get_db()->query("UPDATE post SET date = '$date', title = '$title', content = '$content', photo = '$photo' WHERE postID = $id;");
        } else {
            $ministryID = $value['ministryID'];
            get_db()->query("UPDATE post SET ministryID = '$ministryID', date = '$date', title = '$title', content = '$content', photo = '$photo' WHERE postID = $id;");
        }
    }
    
    // about minister
    function get_ministers() {
        return get_db()->query('SELECT minister.*, ministry.ministryName FROM minister LEFT JOIN ministry USING (ministerID) GROUP BY minister.ministerName ORDER BY ministerID DESC;');
    }
    
    function add_minister($value, $image_path) {
        $name = $value['name'];
        $email = $value['email'];
        $profile = $image_path;
        if (empty($profile) && (empty($email))) {
            get_db()->query("INSERT INTO minister (ministerName) VALUES ('$name');");
        } else if (empty($profile)) {
            get_db()->query("INSERT INTO minister (ministerName, email) VALUES ('$name', '$email');");
        } else if (empty($email)) {
            get_db()->query("INSERT INTO minister (ministerName, profile) VALUES ('$name', '$profile');");
        } else {
            get_db()->query("INSERT INTO minister (ministerName, email, profile) VALUES ('$name', '$email', '$profile');");
        }
    }
    
    function get_edit_minister($id) {
        return get_db()->query("SELECT * FROM minister  WHERE ministerID = $id");
    }
    
    function update_minister($value, $image_path) {
        $name = $value['name'];
        $email = $value['email'];
        $profile = $image_path;
        $id = $value['id'];
        if (empty($profile) && (empty($email))) {
            get_db()->query("UPDATE minister SET ministerName = '$name' WHERE ministerID = $id;");
        } else if (empty($profile)) {
            get_db()->query("UPDATE minister SET ministerName = '$name', email = '$email' WHERE ministerID = $id;");
        } else if (empty($email)) {
            get_db()->query("UPDATE minister SET ministerName = '$name', profile = '$profile' WHERE ministerID = $id;");
        } else {
            get_db()->query("UPDATE minister SET ministerName = '$name', email = '$email', profile = '$profile' WHERE ministerID = $id;");
        }
    }
    
    // about ministry
    function get_ministries() {
        return get_db()->query('SELECT ministry.*, minister.* FROM ministry JOIN minister USING (ministerID) ORDER BY ministryID DESC');
    }

    function add_ministry($value, $image_path) {
        $name = $value['name'];
        $website = $value['website'];
        $mission = $value['mission'];
        $ministerID = $value['ministerID'];
        $logo = $image_path;
        if (empty($logo)) {
            get_db()->query("INSERT INTO ministry (ministerID, ministryName, mission, website) VALUES ('$ministerID', '$name', '$mission', '$website');");
        } else {
            get_db()->query("INSERT INTO ministry (ministerID, ministryName, logo, mission, website) VALUES ('$ministerID', '$name', '$logo', '$mission', '$website');");
        }
    }
    
    function get_edit_ministry($id) {
        return get_db()->query("SELECT * FROM ministry  WHERE ministryID = $id");
    }
    
    function update_ministry($data, $image_path) {
        $id = $data['id'];
        if(!empty($image_path)) {
            get_db()->query("UPDATE ministry SET logo = '$image_path' WHERE ministryID = $id;");
        }
        foreach($data as $key => $value) {
            if(!empty($value) && $key != 'id') {
                get_db()->query("UPDATE ministry SET $key = '$value' WHERE ministryID = $id");
            }
        }
    }
    
    // about user
    function get_users() {
        return get_db()->query('SELECT * FROM user ORDER BY userID DESC');
    }

    function add_user($value, $image_path) {
        $name = $value['name'];
        $email = $value['email'];
        $profile = $image_path;
        if (empty($profile) && (empty($email))) {
            get_db()->query("INSERT INTO minister (ministerName) VALUES ('$name');");
        } else if (empty($profile)) {
            get_db()->query("INSERT INTO minister (ministerName, email) VALUES ('$name', '$email');");
        } else if (empty($email)) {
            get_db()->query("INSERT INTO minister (ministerName, profile) VALUES ('$name', '$profile');");
        } else {
            get_db()->query("INSERT INTO minister (ministerName, email, profile) VALUES ('$name', '$email', '$profile');");
        }
    }
    
    function get_edit_user($id) {
        return get_db()->query("SELECT * FROM minister  WHERE ministerID = $id");
    }
    
    function update_user($value, $image_path) {
        $name = $value['name'];
        $email = $value['email'];
        $profile = $image_path;
        $id = $value['id'];
        if (empty($profile) && (empty($email))) {
            get_db()->query("UPDATE minister SET ministerName = '$name' WHERE ministerID = $id;");
        } else if (empty($profile)) {
            get_db()->query("UPDATE minister SET ministerName = '$name', email = '$email' WHERE ministerID = $id;");
        } else if (empty($email)) {
            get_db()->query("UPDATE minister SET ministerName = '$name', profile = '$profile' WHERE ministerID = $id;");
        } else {
            get_db()->query("UPDATE minister SET ministerName = '$name', email = '$email', profile = '$profile' WHERE ministerID = $id;");
        }
    }

    // delete everything
    function delete($table, $id) {
        get_db()->query("DELETE FROM $table WHERE ".$table.'ID'."= $id");
    }



    // post pagination
    function get_post() {
        // amount in a page
        $amount = 8;

        // setting number of page
        $page = 0;
        isset($_GET['p']) ? $page = $_GET['p'] : $page = 0;

        // check for page 1

        if($page > 1) {
            $start = ($page * $amount) - $amount;
        }else {
            $start = 0;
        }

        $data = get_db()->query("SELECT * FROM post ORDER BY postID DESC LIMIT $start, $amount");

        return $data;
    }
   
    function get_numOf_pages_post() {
        // amount in a page
        $amount = 8;
          
        $data = get_db()->query("SELECT postID FROM post");
        // get total pages
        $numRow = $data->num_rows;

        $totalPage = $numRow / $amount;
        return $totalPage;
    }

    // ministry pagination
    function get_ministry() {
        // amount in a page
        $amount = 6;

        // setting number of page
        $page = 0;
        isset($_GET['pm']) ? $page = $_GET['pm'] : $page = 0;

        // check for page 1

        if($page > 1) {
            $start = ($page * $amount) - $amount;
        }else {
            $start = 0;
        }

        $data = get_db()->query("SELECT ministry.*, minister.* FROM ministry JOIN minister USING (ministerID) ORDER BY ministryID DESC LIMIT $start, $amount");

        return $data;
    }
   
    function get_numOf_pages_ministry() {
        // amount in a page
        $amount = 6;

        $data = get_db()->query("SELECT ministryID FROM ministry");
        // get total pages
        $numRow = $data->num_rows;

        $totalPage = $numRow / $amount;
        return $totalPage;
    }
?> 