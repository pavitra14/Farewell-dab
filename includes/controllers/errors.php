<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 7/4/18
 * Time: 12:53 AM
 */
// Render error messages

function messages() {
    $message = '';
    if($_SESSION['success'] != '') {
        $message = '<div class="row">
					<div class="box">
					<div class="box-body"><div class="alert alert-success">'.$_SESSION['success'].'</div></div></div></div>';
        $_SESSION['success'] = '';
    }
    if($_SESSION['error'] != '') {
        $message = '<div class="row">
					<div class="box">
					<div class="box-body"><div class="alert alert-danger">'.$_SESSION['error'].'</div></div></div></div>';
        $_SESSION['error'] = '';
    }
    echo "$message";
}
function errors($error){
    if (!empty($error))
    {
        $i = 0;
        $showError = "";
        while ($i < count($error)){
            $showError.= "<div class=\"row\">
					<div class=\"box\">
					<div class=\"box-body\"><div class=\"alert alert-danger\">".$error[$i]."</div></div></div></div>";
            $i ++;
        }
        echo $showError;
    }// close if empty errors
} // close function