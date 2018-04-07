<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 7/4/18
 * Time: 5:23 PM
 */

function registerUser($post) {
    global $conn;
    $u_id = genID();
    $username = $post['user'];
    $password = md5($post['pass']);
    $fname = $post['fname'];
    $lname = $post['lname'];
    $email = $post['email'];
    $sex = $post['sex'];
    $enroll = $post['enroll'];
    $branch = $post['branch'];
    $session = $post['session'];
    $passout = $post['passout'];
    $query = "INSERT INTO `user_details`(`u_id`, `username`, `password`, `fname`, `lname`, `email`, `sex`, `enroll`, `branch`, `session`, `passout`) VALUES ('$u_id','$username','$password','$fname','$lname','$email','$sex','$enroll','$branch','$session','$passout')";
    if(mysqli_query($conn, $query)) {
        //Registration Successfull
        echo '<script>alert("Registration Successful, You may now login.")</script>';
        $_SESSION['success'] ="Registration Successful, You may now login.";
        header('Location: login.html');
        exit();
    } else {
        $_SESSION['error'] = "Registrations are closed right now :(";
    }

}