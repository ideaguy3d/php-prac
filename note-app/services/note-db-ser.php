<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/11/2017
 * Time: 7:43 PM
 */
session_start();
//header('Content-type: application/json');
//echo ")]}'\n";
if (array_key_exists('content', $_GET)) {
    include('..\connection.php');
    $content = mysqli_real_escape_string($link, $_GET['content']);
    $email = $_GET['email'];
    // echo 'content = ' . $content . ' email = ' . $email;
    $query = 'update users set notes = "' . $content . '" where email ="' . $email . '" limit 1';
    mysqli_query($link, $query);
}

