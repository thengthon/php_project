<?php

    function get_db() {
        return new mysqli('localhost', 'root', '', 'php_project');
    }

    // upload image
    function upload($my_file) {
        $img_name = $my_file['name'];
        $img_size = $my_file['size'];
        $tmp_name = $my_file['tmp_name'];
        $error = $my_file['error'];

        if($error === 0) {
            if($img_size > 1000000) {
                $mes = "Try again, you file is too larg...";
                header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231&mese=$mes");
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
                    header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231&mese=$mes");
                }
            }
        } else {
            $mes = "Unknown error occured!";
            header("location: http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231&mese=$mes");
        }
    }

    // login process
    function login($data) {
        $name = $data['l-username'];
        $pwd = $data['l-password'];
        $valid_user = false;
        $users = get_db()->query("SELECT * FROM user;");
        foreach($users as $user) {
            if (password_verify($pwd, $user['password']) && $user['username'] == $name) {
                $valid_user = $user;
                break;
            }
        }
        return $valid_user;
    }
    
// ==== about post

    // get all inactivated post to display
    function get_inactivated_news() {
        return get_db()->query('SELECT post.*, ministry.ministryName, user.username FROM post JOIN ministry USING (ministryID) JOIN user USING (userID) WHERE activated = 0');
    }

    // to enable activate news
    function enable_news($id) {
        get_db()->query("UPDATE post SET activated = 1 WHERE postID = $id;");
    }

    // get post to display detail
    function get_detail_post($id) {
        if ($id === -1) {
            return get_db()->query("SELECT post.*, ministry.ministryName, user.username FROM post JOIN ministry USING (ministryID) JOIN user USING (userID) LIMIT 1;");
        } else {
            return get_db()->query("SELECT post.*, ministry.ministryName, user.username FROM post JOIN ministry USING (ministryID) JOIN user USING (userID) WHERE postID = $id;");
        }
    }

    // get inactivated post to display detail
    function get_detail_a_post($id) {
        if ($id === -1) {
            return get_db()->query("SELECT post.*, ministry.ministryName, user.username FROM post JOIN ministry USING (ministryID) JOIN user USING (userID) WHERE activated = 0 LIMIT 1;");
        } else {
            return get_db()->query("SELECT post.*, ministry.ministryName, user.username FROM post JOIN ministry USING (ministryID) JOIN user USING (userID) WHERE postID = $id;");
        }
    }

    // get posts to display
    function get_news() {
        return get_db()->query('SELECT post.*, ministry.ministryName, user.username FROM post JOIN ministry USING (ministryID) JOIN user USING (userID) WHERE activated = 1 ORDER BY postID DESC;');
    }
    
    // create post by admin or user
    function create_post($value, $image_path) {
        date_default_timezone_set('Asia/Phnom_Penh');
        $today = new DateTime();
        $date = $today->format("F j, Y, g:i a");
        $userID = $value['userID'];
        $title = $value['title'];
        $content = $value['content'];
        $photo = $image_path;
        $activated  = $value['activated'];
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
    
    // get post to edit
    function get_edit_news($id) {
        return get_db()->query("SELECT * FROM post  WHERE postID = $id");
    }
    
    // edit post
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
    
// ==== about minister

    // get all ministers to display on admin page
    function get_ministers() {
        return get_db()->query('SELECT minister.*, ministry.ministryName FROM minister LEFT JOIN ministry USING (ministerID) GROUP BY minister.ministerName ORDER BY ministerID DESC;');
    }
    
    // add new minister
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
    
    // get minister to edit
    function get_edit_minister($id) {
        return get_db()->query("SELECT * FROM minister  WHERE ministerID = $id");
    }
    
    // edit minister
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
    
// ==== about ministry

    // get all ministries to display on admin page
    function get_ministries() {
        return get_db()->query('SELECT ministry.*, minister.* FROM ministry JOIN minister USING (ministerID) ORDER BY ministryID DESC');
    }

    // add new ministry
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
    
    // get ministry to edit
    function get_edit_ministry($id) {
        return get_db()->query("SELECT * FROM ministry  WHERE ministryID = $id");
    }
    
    // edit minsitry
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
    
// ==== about user

    // get all users to display on admin page
    function get_users() {
        return get_db()->query('SELECT * FROM user ORDER BY userID DESC');
    }

    // create new user (can be admin or normal user) : only admin can create another admin
    function create_user($data) {
        $name = $data['s-username'];
        $pass = $data['s-password'];
        $pwd = password_hash($data['s-password'], PASSWORD_DEFAULT);
        $email = $data['s-email'];
        $is_valid_user = true;
        $users = get_db()->query("SELECT username, password FROM user;");
        foreach($users as $user) {
            if (password_verify($pass, $user['password']) && $user['username'] == $name) {
                $is_valid_user = false;
                break;
            }
        }
        if ($is_valid_user) {
            if(isset($_POST['role'])) {
               $role = $data['role'];
               get_db()->query("INSERT INTO user (username, password, email, role) VALUES ('$name', '$pwd', '$email', '$role');");
            } else {
                get_db()->query("INSERT INTO user (username, password, email) VALUES ('$name', '$pwd', '$email');");
            }
        } else {
            return 1;
        }
    }
    
    // get user to edit
    function get_edit_user($id) {
        return get_db()->query("SELECT * FROM minister  WHERE ministerID = $id");
    }
    
    // edit user
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

    // delete post, user, minister or ministry
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

        $data = get_db()->query("SELECT * FROM post WHERE activated = 1 ORDER BY postID DESC LIMIT $start, $amount;");

        return $data;
    }
   
    function get_numOf_pages_post() {
        // amount in a page
        $amount = 8;
          
        $data = get_db()->query("SELECT postID FROM post WHERE activated = 1;");
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