<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/6/2017
 * Time: 8:52 AM
 */

function jBreak()
{
    echo "<br><br><hr><br>";
}

// Local MySQL for development environment:

$hostname = '127.0.0.1'; $username = 'root'; $password = ''; $databaseName = 'alphacrm';
$randomInt = rand() * rand(0, 255); jBreak();
$table = "tdesigners"; $query = '';
$link = mysqli_connect($hostname, $username, $password, $databaseName);

if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {
    $email = mysqli_real_escape_string($link, $_POST['email']);

    if($email == '') {
        echo '<h4>Email required!</h4>';
    } else if ($_POST['password'] == '') {
        echo '<h4>Password required!</h4>';
    } else {
        // $query = "select id from $table where email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
        $query = "select id from $table where email = '$email'";

        $result = mysqli_query($link, $query);

        // if query returns a row/record the email already exists in the database.
        if(mysqli_num_rows($result) > 0) {
            echo '<h4>That email is already taken.</h4>';
        }
    }
}

if (mysqli_connect_error()) {
    echo 'database connection failed';
    die ('<br><br> Failed to connect to remote MySQL database');
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

</head>


<body>

<div class="container">
    <h1>Ello World ^_^/
        <small>~Julius Alvarado :)</small>
    </h1>

    <br>

    <!-- html coding begin: -->

    <form action="" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Send it!">
    </form>

</div>

</body>
</html>


