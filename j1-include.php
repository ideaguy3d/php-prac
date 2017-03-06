<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/5/2017
 * Time: 5:32 PM
 */

$jhaFormError = '';
$mailError = '';
$successMessage = '';

function jBreak() {
    echo "<br><br><hr><br>";
}

function add2error($sub) {
    global $jhaFormError;
    // echo '<br>add2error() line 17ish... add2error() var paramter ='.$sub;
    $jhaFormError .= 'ERROR: ' . $sub . ' is required ! <br>';
}

function jhaValidation() {
    global $jhaFormError;
    global $mailError;
    global $successMessage;

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    if (!$email) {
        add2error('email');
    }

    if (!$subject) {
        add2error('subject');
    }

    if (!$content) {
        add2error('description');
    }

    // filter email
    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        add2error('Valid Email');
    }

    if ($jhaFormError != '') { // error is !empty then there has been an validation error.
        $jhaFormError .= '<div class="alert alert-danger" role="alert">' . $jhaFormError . '</div>';
    } // Send email code:
    else {
        $emailTo = 'javascript.uiux@gmail.com';
        $subject = $_POST['subject'];
        $content = $_POST['content'];
        $headers = 'From: ' . $_POST['email'];

        if (mail($emailTo, $subject, $content, $headers)) {
            $successMessage = '<div class="alert alert-success" role="alert">Form submitted successfully. </div>';
        } else {
            $mailError = '<div class="alert alert-danger" role="alert">The email failed.</div>';
        }
    }

    if ($jhaFormError === '') { // error str is empty so there hasn't been an error.
        // $jhaFormError .= '<div class="alert alert-success" role="alert"> Form submitted successfully. </div>';
        // echo 'jhaValidation() line 48ish... there is not an error, this should work... hmm.';
        // echo '... error = ' . $jhaFormError;
    }

    // echo '<br>jhaValidation() line 47ish... jhaValidation has been invoked, error = '.$jhaFormError;
}

if ($_POST) {

    // print_r($_POST);

    jhaValidation();

}