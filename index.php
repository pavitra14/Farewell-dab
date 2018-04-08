<?php
include_once './includes/functions.php';
//This file does not contain any page code itself, it just calls the required file as per the requirements.
if(!logged_in()) {
    require_once 'views/front.php';
}
//if statement to redirect to write page after login if redirect is set.
if(isset($_SESSION['redirect']) && $_SESSION['redirect'] != null) {
    $w = $_SESSION['redirect'];
    unset($_SESSION['redirect']);
    header('Location: index.html?w='.$w);
    exit();
}

if($_POST['msgPost'] == 1) {
    //msg is post, get all the parameters from post and feed it to our function
    $post = $_POST;
    $status = msgPost($post);
    if($status == true) {
        //Post successfull!
        echo '<script>alert("Posted on their Dab wall!");</script>';
    }
}




//if-elseif statements to handle custom views.
//these are to be at the last.
if (isset($_GET['w']) && $_GET['w'] != null) {
    require_once 'views/write.php';
}elseif ($_SESSION['authorized'] == true) {
    require_once 'views/feed.php';
}
