<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/6/2017
 * Time: 10:00 PM
 */

$database = require 'core/bootstrap.php';

$router = new Router;

require 'routes.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
//$uri = $_SERVER['REQUEST_URI'];

echo $uri;
echo '<br>------------------<br>';

require $router->direct($uri);


//