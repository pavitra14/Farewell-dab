<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 13/4/18
 * Time: 11:27 PM
 */
/**
 * @param UserID
 * @return array|null
 */
function getUserFromUID($u_id){
    global $conn;
    $query = "SELECT * FROM user_details WHERE u_id = '$u_id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) != 0) {
        //Single user
        $r = mysqli_fetch_array($result);
        return $r;
    } else {
        return null;
    }
}

/**
 * @param User ID
 * @return No. of Posts
 */
function countPosts($u_id) {
    global $conn;
    $query = "SELECT * FROM posts WHERE to_id='$u_id'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    return $rows;
}

/**
 * To get writeup url from full name
 * @return Write up Link
 */
/**
 * @param string $mode
 */
function getURLFromName($mode = 'search', $query = null){
    global $conn;
    $full_name = '';
    if($query != null) {
        $full_name = trim($query);
    } else {
        $full_name = trim($_GET['full_name']);
    }
    $arr_name = explode(" ", $full_name);
    $fname = $arr_name[0];
    $lname = $arr_name[1];
    $query = "SELECT * FROM user_details WHERE fname='$fname' AND lname='$lname'";
    $result=mysqli_query($conn, $query);
    $output = '';
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $username = $row['username'];
        $output = "https://farewell.pbehre.in/?w=";
        $output .= $username;
    } else {
        $output = "#";
    }
    if($mode == 'search') {
        header('Location: '. $output);
    } else {
        print $output;
    }
}


/**
 * To enforce ssl
 */
function requireSSL() {
    if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on")
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
}

/**
 * @return bool
 */
function isLocalhost() {
    if($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
        return true;
    } else {
        return false;
    }
}

/**
 * To generate random ids
 * @return int
 */
function genID() {
    $id = mt_rand(1,999999);
    return $id;
}

/**
 * @param $data
 * @return string
 */
function escape($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

function ifAdmin() {
    if($_SESSION['admin'] == true) {
        $btn = '<li><a href="?admin=1" onclick="alert(\'Soon.\')">Admin</a></li>';
        return $btn;
    }
}