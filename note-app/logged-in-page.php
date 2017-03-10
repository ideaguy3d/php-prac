<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/10/2017
 * Time: 12:25 AM
 */

session_start();

if(array_key_exists("id", $_COOKIE)) {
    $_SESSION['id'] = $_COOKIE['id'];
}

if(array_key_exists("id", $_SESSION)) {
    echo "<p>Logged in! <a href='index.php?logout=1'>Logout</a></p>";
} else {
    header("Location: index.php");
    // echo 'You are not supposed to be here';
}



//