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