<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/6/2017
 * Time: 12:05 PM
 */

function jBreak()
{
    echo "<br><br><hr><br>";
}

// Local MySQL for development:

$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$databaseName = 'alphacrm';

$link = mysqli_connect($hostname, $username, $password, $databaseName);

if (mysqli_connect_error()) {
    echo 'database connection failed';
    die ('<br><br> Failed to connect to remote MySQL database');
}

$randomInt = rand() * rand(0, 255); // generate id
//echo $randomInt;
jBreak();

$table = "tdesigners";
$query = '';

/*
//-- prior sql query practice:
$query = "INSERT INTO tdesigners (id, email, password) VALUES($randomInt, 'romulus@julius3d.com', 'abc123')";
$query = "update $table set email = 'augustus@julius3d.com' where id = 0 limit 1";
$query = "update $table set password = 'abc123' where email = 'augustus@julius3d.com' limit 1";
$query = "select * from $table where email like '%julius3d.com'";
$query = "select * from $table where email like '%j%'";
$query = "select * from $table where id < 10";
$query = 'select * from $table where id = 0';

*/

echo $query;
jBreak();

$query = "select Skills from $table where Skills like '%a%' and id < 10";

if ($result = mysqli_query($link, $query)) {
    // $row = mysqli_fetch_array($result)

    while ($row = mysqli_fetch_array($result)) {
        print_r($row);
    }

    jBreak();
} else {
    echo 'failed query';
}
