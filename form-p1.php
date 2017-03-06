<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/4/2017
 * Time: 9:52 PM
 */

// this php form code doesn't quite work. It mostly works but doesn't properly insert error/success messages

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

?> <!-- END OF: php block -->


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>


<body>

<div class="container">
    <br><br><br>

    <h1>Contact Us Now</h1>

    <div id="error"> <? echo $jhaFormError . $successMessage . $mailError; ?> </div>

    <form method="post">

        <!-- email -->
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                   placeholder="Enter email">
        </div>

        <p>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </p>

        <!-- password -->
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
        </div>

        <!-- textarea -->
        <div class="form-group">
            <label for="content">Description</label>
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Description"></textarea>
        </div>

        <!-- file upload explorer
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
        </div>
        -->

        <!-- submit button -->
        <button id="submit" type="submit" class="btn btn-primary">Send it</button>
    </form>

</div>


<!-- jQuery first, then Tether, then Bootstrap JS. -->
<!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>

<script type="text/javascript">

    (function ($) {
        $("form").submit(function (e) {

            var error = "";

            // simple client side validation
            if ($('#email').val() == "") {
                error += "<p>Email field is required ! Please.</p><b>";
            }

            if ($('#subject').val() == "") {
                error += "<p>Subject field is required ! Please.</p><b>";
            }

            if ($('#content').val() == "") {
                error += "<p>Content is required ! Please.</p><b>";
            }

            // now display error message in the web page
            if (error != "") { // if the error str is not empty then there has been an error
                e.preventDefault();
                $('#error').html('<div class="alert alert-danger" role="alert">' + error + '</div>');
            } else {
                $('form').unbind('submit').submit();
            }

            console.log('jQuery has been invoked...');
        });
    }(jQuery));

</script>

</body>
</html>


