<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 7/4/18
 * Time: 10:48 PM
 */
$w = $_GET['w'];
if(!logged_in()) {
    $_SESSION['error'] = "You need to login first.";
    $_SESSION['redirect'] = $w;
    header('Location: ../login.html');
    exit();
}
echo $w;