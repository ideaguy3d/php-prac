<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/11/2017
 * Time: 9:43 AM
 */

session_start();
$error = '';

if (array_key_exists("logout", $_GET)) {
    unset($_SESSION);
    setcookie('id', '', time() - 60 * 60);
    $_COOKIE['id'] = '';
} else if ( (array_key_exists('id', $_SESSION) AND $_SESSION['id'])
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
            $query = 'select * from `users` where email="'.$email.'"';
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>www.julius3d.com</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
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
    </style>
</head>

<body>
<br>
<hr>
<section class="container">
    <h1>Sign up or Login Now</h1>
    <div id="error"><?= $error; ?></div>
    <!-- Sign up section: -->
    <form action="" method="post">
        <input id="email" type="email" name="email" placeholder="email">
        <input id="password" type="password" name="password" placeholder="password">
        <label for="stayLoggedIn">Stay logged in?</label>
        <input id="stayLoggedIn" type="checkbox" name="stayLoggedIn" value=1>
        <input type="hidden" name="signUp" value="1">
        <input type="submit" name="submit" class="btn btn-primary" value="Sign Up">
    </form>
    <br>
    <!-- Login in section: -->
    <form method="post">
        <input id="email" type="email" name="email" placeholder="email">
        <input id="password" type="password" name="password" placeholder="password">
        <label for="stayLoggedIn">Stay logged in?</label>
        <input id="stayLoggedIn" type="checkbox" name="stayLoggedIn" value=1>
        <input type="hidden" name="signUp" value="0">
        <input type="submit" name="submit" class="btn btn-primary" value="Login">
    </form>
</section>
</body>
</html>