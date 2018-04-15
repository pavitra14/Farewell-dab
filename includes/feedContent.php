<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 13/4/18
 * Time: 11:21 PM
 * purpose - This file will handle all the feed related ajax queries
 */
include_once 'functions.php';
if(!empty($_GET['like'])) {
    like();
}elseif(!empty($_GET['search_key'])) {
    search();
}elseif(!empty($_GET['full_name'])){
    getURLFromName();
}elseif(!empty($_GET['delete'])){
    deletePost();
} else {
    getFeed();
}