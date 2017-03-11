<?php
session_start();
$error = '';

if (array_key_exists("logout", $_GET)) {
    unset($_SESSION);
    setcookie('id', '', time() - 60 * 60);
    $_COOKIE['id'] = '';
} else if ((array_key_exists('id', $_SESSION) AND $_SESSION['id'])
    OR (array_key_exists('id', $_COOKIE) AND $_COOKIE['id'])
) {
    header('Location: logged-in-page.php');
}

if (array_key_exists('email', $_POST)) {
    $link = mysqli_connect('127.0.0.1', 'root', '', 'users');
    if (mysqli_connect_error()) die ('There has been a Database connection error :(');

    if (!$_POST['email']) {
        $error .= 'Email is required<b>';
    }
    if (!$_POST['password']) {
        $error .= 'Password is required<b>';
    }
    if ($error != '') {
        $error = '<p>There were errors: </p>' . $error;
    } else { // there were no errors signing up
        if ($_POST['signUp'] == '1') { // user is signing up
            #region //-- signing up code:
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $password = mysqli_real_escape_string($link, $_POST['password']);
            $query = "select `id` from `users` where email = '$email' limit 1";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) {
                $error = 'That email is already taken';
            } else {
                $query = "insert into users (email, password) VALUES ('$email', '$password')";
                if (!mysqli_query($link, $query)) {
                    $error .= 'Error signing you up. Please try again.';
                } else {
                    $recentId = mysqli_insert_id($link); // gets id of most recently inserted record
                    $hashedPassword = md5(md5(mysqli_insert_id($link)) . $_POST['password']);
                    $query = 'update users set password = "$hashedPassword" where id = "$recentId" limit 1';
                    mysqli_query($link, $query);
                    $_SESSION['id'] = $recentId;
                    if ($_POST['stayLoggedIn'] == '1') {
                        setcookie("id", $recentId, time() + 60 * 60 * 24);
                    }
                    //logged-in-page.php
                    header('Location: logged-in-page.php');
                }
            }
            #endregion
        } else {
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $query = 'select * from `users` where email="' . $email . '"';
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result); //
            if (isset($row)) {
                echo 'in password check region';
                // $hashedPassword = md5(md5($row['id']) . $_POST['password']); // this doesn't work :(
                $password = mysqli_real_escape_string($link, $_POST['password']);
                if ($password == $row['password']) {
                    $_SESSION['id'] = $row['id'];
                    if ($_POST['stayLoggedIn'] == '1') {
                        setcookie('id', $row['id'], time() * 60 * 60);
                    }
                    header('Location: logged-in-page.php');
                } else {
                    echo 'jha - passwords did not match';
                }
            } else {
                $error .= 'that email/password combination could not be found';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <style>
        html {
            background: url(bg1280.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        body {
            background: none;
            color: whitesmoke;
        }

        .jcol {
            float: left;
            width: 50%;
        }

        .btn {
            cursor: pointer;
        }

        #error {
            color: indianred;
        }

        .display {
            display: none;
        }
    </style>
</head>

<body>
<br>
<hr>
<section class="container">
    <div class="text-center">
        <h1>Note Taking Application</h1>
        <h5>The internets best note taking app. Give it a try and Find out for yourself!</h5>
    </div>
    <div id="error"><?= $error; ?></div>
    <!-- Sign up form: -->
    <form id="signup-form" method="post">
        <h1>Sign up</h1>
        <fieldset class="form-group">
            <input id="email" class="form-control" type="email" name="email" placeholder="email">
        </fieldset>
        <fieldset class="form-group">
            <input id="password" class="form-control" type="password" name="password" placeholder="password">
        </fieldset>
        <div class="checkbox">
            <label for="stayLoggedIn">
                Stay logged in? <input id="stayLoggedIn" type="checkbox" name="stayLoggedIn" value=1>
            </label>
        </div>
        <fieldset class="form-group">
            <input type="hidden" name="signUp" value="1">
            <input type="submit" name="submit" class="btn btn-primary" value="Sign Up">
        </fieldset>
        <p><a class="switch-form btn btn-success btn-sm">Or Login</a></p>
    </form>
    <!-- Login form: -->
    <form id="login-form" class="display" method="post">
        <h1>Login</h1>
        <fieldset class="form-group">
            <input id="email" class="form-control" type="email" name="email" placeholder="email">
        </fieldset>
        <fieldset class="form-group">
            <input id="password" class="form-control" type="password" name="password" placeholder="password">
        </fieldset>
        <fieldset class="form-group">
            <label for="stayLoggedIn">Stay logged in?</label>
            <input id="stayLoggedIn" type="checkbox" name="stayLoggedIn" value=1>
        </fieldset>
        <fieldset class="form-group">
            <input type="hidden" name="signUp" value="0">
            <input type="submit" name="submit" class="btn btn-primary" value="Login">
        </fieldset>
        <p><a class="switch-form btn btn-success btn-sm">Or Sign up</a></p>
    </form>
</section>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    (function ($) {
        $('.switch-form').click(function () {
            $('#signup-form').toggle('display');
            $('#login-form').toggle('display');
        });
    }(jQuery));
</script>
</body>
</html>





