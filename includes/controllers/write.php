<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 8/4/18
 * Time: 5:38 PM
 */
/**
 * @param $w|username
 * @return array|null
 */
function getfromW($w){
    global $conn;
    $query = "SELECT * FROM user_details WHERE username='$w'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0) {
        //No such user exists. return null.
        return null;
    } else {
        $w_details = mysqli_fetch_array($result);
        return $w_details;
    }
}

/**
 * @param $post
 * @return bool
 */
function msgPost($post) {
    global $conn;
    $p_id = genID();
    $from_id = $post['from_id'];
    $to_id = $post['to_id'];
    $to_email = $post['to_email'];
    $to_fname = $post['to_fname'];
    $from_name = $post['from_name'];
    $msg = $post['msg'];
    $date_created = date("Y-m-d H:i:s");// 2001-03-10 17:16:18 (the MySQL DATETIME format)
    $likes = 0;
    $query = "INSERT INTO `posts`(`p_id`, `from_id`, `to_id`, `msg`, `date_created`, `likes`) VALUES ('$p_id','$from_id','$to_id','$msg','$date_created','$likes')";
    if(mysqli_query($conn, $query)) {
        //post successful
        mailNewPost($to_email, $from_name, $to_fname);
        return true;
    } else {
        return false;
    }
}