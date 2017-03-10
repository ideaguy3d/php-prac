<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/9/2017
 * Time: 12:15 AM
 */

session_start();

if($_SESSION['email']) {
    echo 'You are logged in';
} else {
    header('Location: index.php');
}

