<?php
/**
 * Created by PhpStorm.
 * User: pavitra14
 * Date: 9/4/18
 * Time: 11:27 PM
 */

$templates = array(
    "new_account" => "email_new.html",
    "new_post" => "email_post.html"
);
$subjects = array(
    "new_account" => "Welcome to FarewellDab!",
    "new_post" => "You've got a new Dab!"
);
$noreply = 'no-reply@pbehre.in';
/**
 * @param $from email
 * @return $headers string
 */
function construct_headers($from) {
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    return $headers;
}

/**
 * @param $template
 * @return bool|string
 */
function construct_email($template) {
    $file = __DIR__ .'/../../templates/' . $template;
    if(file_exists($file)) {
        $html = file_get_contents($file);
        return $html;
    } else {
        $html = "404 Template not found - " . $file;
        return $html;
    }
}

/**
 * @param $to
 * @param $subject
 * @param $message
 * @param $headers
 * @return bool
 */
function sendMail($to,$subject,$message,$headers) {
    if(mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $to
 * @param $fname
 * @param $username
 * @return bool
 */
function mailNewAccount($to, $fname, $username) {
    global $noreply;
    global $templates;
    global $subjects;
    $headers = construct_headers($noreply);
    $message = construct_email($templates['new_account']);
    $subject = $subjects['new_account'];
    $message = str_replace("[[FIRST_NAME]]", $fname, $message); //replace the first parameter
    $write_link = SITE_URL.'?w=' . $username;
    $message = str_replace("[[WRITE_LINK]]", $write_link, $message); //replace the 2nd parameter
    return sendMail($to, $subject, $message, $headers);
}

/**
 * @param $to
 * @param $from_name
 * @param $fname
 * @return bool
 */
function mailNewPost($to,$from_name, $fname) {
    global $noreply;
    global $templates;
    global $subjects;
    $headers = construct_headers($noreply);
    $message = construct_email($templates['new_post']);
    $subject = $subjects['new_post'];
    $message = str_replace("[[FIRST_NAME]]", $fname, $message); //1st parameter
    $message = str_replace("[[FROM_NAME]]", $from_name, $message); //2nd parameter
    $message = str_replace("[[SITE_URL]]", SITE_URL, $message); //3rd parameter
    return sendMail($to, $subject, $message, $headers);
}