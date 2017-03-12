<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/11/2017
 * Time: 4:13 PM
 */

$link = mysqli_connect('127.0.0.1', 'root', '', 'users');
if (mysqli_connect_error()) die ('There has been a Database connection error :(');