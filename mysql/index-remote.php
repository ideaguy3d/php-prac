<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/6/2017
 * Time: 1:19 AM
 */

// Remote connection to ecowebhosting:

$dbHost = 'shareddb1b.hosting.stackcp.net';
$username = 'jusers-35b0a9';
$dbPassword = ''; // will load this from environment variable eventually
$dbDatabase =  'jusers-35b0a9';

$link = mysqli_connect($dbHost, $username, $dbPassword, $dbDatabase);

if(mysqli_connect_error()) {
    echo 'database connection failed';
    die ('<br><br> Failed to connect to remote MySQL database');
}

// 1st query
$query1 = 'select * from users1';
$result = mysqli_query($link, $query1);

if ($result) {
    $row = mysqli_fetch_row($result);
    print_r($row);
    echo "<br><br>  Query was a success";
} else {
    echo 'failed query';
}