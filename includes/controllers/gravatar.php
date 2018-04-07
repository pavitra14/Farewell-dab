<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 7/4/18
 * Time: 12:20 PM
 */
/**
 * @param string $email
 * @param int $size
 * @param string $rating
 * @return string
 */
function gravatar($email = '', $size = 60, $rating = 'pg' ) {
    $email = md5(strtolower(trim($email)));
    $gravurl = "http://www.gravatar.com/avatar/$email?s=$size&r=$rating";
    return $gravurl;
}