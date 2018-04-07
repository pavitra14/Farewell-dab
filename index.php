<?php
include_once './includes/functions.php';
//This file does not contain any page code itself, it just calls the required file as per the requirements.
if(!logged_in()) {
    require_once 'views/front.php';
}
if($_SESSION['authorized'] == true) {
    require_once 'views/feed.php';
}