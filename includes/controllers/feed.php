<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 13/4/18
 * Time: 11:25 PM
 */
/**
 * @return bool|string
 */
function getFeedTemplate() {
    $file = __DIR__ .'/../../templates/feed_box.html';
    if(file_exists($file)) {
        $html = file_get_contents($file);
        return $html;
    } else {
        $html = "404 Template not found - " . $file;
        return $html;
    }
}

/**
 * To generate the feed from Database
 */
function getFeed(){
    global $conn;
    $perPage = 10;
    $page = 1;
    $sql = "SELECT * FROM posts ORDER BY date_created desc";
    if(!empty($_GET['page'])) {
        $page = $_GET['page'];
    }
    $start = ($page -1)*$perPage;
    $query = $sql . " limit " . $start . "," . $perPage;
    $result = mysqli_query($conn,$query);
    if(empty($_GET['rowcount'])) {
        $_GET['rowcount'] = mysqli_num_rows($result);
    }
    $total_rows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM posts")); //Very crucial bug fix.
    $pages = ceil($total_rows/$perPage);
    $rowcount = $_GET['rowcount'];
    $output = '';
    $output .= '<input type="hidden" class="pagenum" value="'.$page.'" /><input type="hidden" class="total-page" value="'.$pages.'"/><input type="hidden" class="rowcount" value="'.$rowcount.'"/>';
    if(mysqli_num_rows($result) != 0) {
        //$r = mysqli_fetch_array($result);
        $feedCont = getFeedTemplate();
        //die(json_encode($r));
        //foreach ($r as $q) {
        while($q = mysqli_fetch_array($result)) {
            $POST_ID = $q['p_id'];
            $CONTENT = $q['msg'];
            $LIKES = $q['likes'];
            $from_user = getUserFromUID($q['from_id']);
            $to_user = getUserFromUID($q['to_id']);
            $FROM = $from_user['fname'] . ' ' . $from_user['lname'];
            $TO = $to_user['fname'] . ' ' . $to_user['lname'];
            $post = str_replace("[[FROM]]", $FROM, $feedCont);
            $post = str_replace("[[TO]]", $TO, $post);
            $post = str_replace("[[CONTENT]]", $CONTENT, $post);
            $post = str_replace("[[POST_ID]]", $POST_ID, $post);
            $post = str_replace("[[LIKES]]", $LIKES, $post);
            $post = str_replace("[[ACTION_CSS]]", "warning", $post);
            $post = str_replace("[[ACTION_CLICK]]", "reportPost('".$POST_ID."')", $post);
            $post = str_replace("[[ACTION]]", "Report", $post);
            $output .= $post;
        }
    } else {
        $output .= 'No new posts!';
    }
    print $output;
}

/**
 * to handle like button ajax calls
 */
function like() {
    global $conn;
    if(!empty($_POST['p_id'])) {
        $p_id = $_POST['p_id'];
        switch ($_POST['action']) {
            case "like":
                $query = "UPDATE posts SET likes=likes+1 WHERE p_id = '$p_id'";
                mysqli_query($conn,$query);
                break;
            case "unlike":
                $query = "UPDATE posts SET likes=likes-1 WHERE p_id = '$p_id'";
                mysqli_query($conn, $query);
                break;

        }
    }
}

/**
 * @param $u_id
 * @param $mode
 * @return string
 */
function getUserFeed($u_id, $mode) {
    global $conn;
    $query = "SELECT * FROM posts WHERE to_id='$u_id' ORDER BY date_created desc";
    $result = mysqli_query($conn, $query);
    $output = '';
    if(mysqli_num_rows($result) != 0) {
        $feedCont = getFeedTemplate();
        //die(json_encode($r));
        //foreach ($r as $q) {
        while ($q = mysqli_fetch_array($result)) {
            $POST_ID = $q['p_id'];
            $CONTENT = $q['msg'];
            $LIKES = $q['likes'];
            $from_user = getUserFromUID($q['from_id']);
            $to_user = getUserFromUID($q['to_id']);
            $FROM = $from_user['fname'] . ' ' . $from_user['lname'];
            $TO = $to_user['fname'] . ' ' . $to_user['lname'];
            $post = str_replace("[[FROM]]", $FROM, $feedCont);
            $post = str_replace("[[TO]]", $TO, $post);
            $post = str_replace("[[CONTENT]]", $CONTENT, $post);
            $post = str_replace("[[POST_ID]]", $POST_ID, $post);
            $post = str_replace("[[LIKES]]", $LIKES, $post);
            $post = str_replace("col-md-8 col-md-offset-2", "col-md-12", $post); // A Small fix for profile page
            $post = str_replace("box-success", "box-info", $post); //A Smal UI fix for profile page
            if($mode == "write") {
                $post = str_replace("[[ACTION_CSS]]", "warning", $post);
                $post = str_replace("[[ACTION_CLICK]]", "reportPost('".$POST_ID."')", $post);
                $post = str_replace("[[ACTION]]", "Report", $post);
            } elseif($mode == "profile") {
                $post = str_replace("[[ACTION_CSS]]", "danger", $post);
                $post = str_replace("[[ACTION_CLICK]]", "deletePost('".$POST_ID."')", $post);
                $post = str_replace("[[ACTION]]", "Delete", $post);
            }
            $output .= $post;
        }
    }else {
        $output .= "No new messages.";
    }
    return $output;
}

/**
 * To handle navbar search
 */
function search(){
    global $conn;
    $key = $_GET['search_key'];
    $query = "SELECT * FROM user_details WHERE username LIKE '%$key%' OR  fname LIKE '%$key%' OR lname LIKE '%$key%' OR email LIKE '%$key%'";
    $result = mysqli_query($conn, $query);
    $array = array();
    while($row=mysqli_fetch_array($result)){
        $array[] = trim($row['fname']) . ' ' . trim($row['lname']) . '#'. trim($row['u_id']);
    }
    $output = json_encode($array);
    print $output;
}

/**
 * to handle post deletes
 */
function deletePost() {
    global $conn;
    if(!empty($_POST['p_id'])) {
        $p_id = $_POST['p_id'];
        $query = "DELETE FROM posts WHERE p_id='$p_id'";
        mysqli_query($conn,$query);
    }
}