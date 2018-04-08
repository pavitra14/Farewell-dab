<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 7/4/18
 * Time: 12:55 AM
 */

function login($user, $pass) {
    global $conn;
    $user = escape($user);
    $pass = escape(md5($pass));
    if($user == '' || $pass == '') {
        $_SESSION['error'] = 'You cannot leave the fields empty';
    } else {
        $query = "SELECT * FROM user_details WHERE username='$user' AND password='$pass'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1) {
            $_SESSION['authorized'] = true;
            $_SESSION['arr_details'] = mysqli_fetch_array($result);
            $_SESSION['type'] = $_SESSION['arr_details']['passout'];
            header('Location: index.html');
            exit();
        } else {
            $_SESSION['error'] = 'Incorrect Credentials';
        }
    }
}

function logged_in() {
    if($_SESSION['authorized'] == true) {
        return true;
    } else {
        return false;
    }
}

function login_required() {
    if(logged_in()) {
        return true;
    } else {
        header('Location: login.html');
        exit();
    }
}

function logout(){
    unset($_SESSION['authorized']);
    unset($_SESSION['type']);
    unset($_SESSION['arr_details']);
    unset($_SESSION['redirect']);
    if(isset($_COOKIE['logged_in'])) {
        setcookie("logged_in", "", time() - 3600);
    }
    session_destroy();
    header('Location: index.html');
    exit();
}
//logout trigger
if ( isset( $_GET[ 'logout' ] ) ) {
    logout();
}