<?php
$error = '';


if (array_key_exists('email', $_POST)) {
    $link = mysqli_connect('127.0.0.1', 'root', '', 'users');
    if (mysqli_connect_error()) die (' There has been a Database connection error :(');

    if (!$_POST['email']) {
        $error .= 'Email is required<b>';
    }
    if (!$_POST['password']) {
        $error .= 'Password is required<b>';
    }
    if ($error != '') {
        $error = '<p>There were errors: </p>' . $error;
    } else {
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
                echo 'Successful signing you up.';
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
<section class="container">
    <h1>Sign up</h1>
    <div id="error"><?= $error; ?></div>
    <!-- html coding begin: -->
    <form action="" method="post">
        <input id="email" type="email" name="email" placeholder="email">

        <input id="password" type="password" name="password" placeholder="password">

        <label for="stayLoggedIn">Stay logged in?</label>
        <input id="stayLoggedIn" type="checkbox" name="stayLoggedIn" value="1">

        <input type="submit" name="submit" class="btn btn-primary" value="Sign in">
    </form>
</section>
</body>
</html>



