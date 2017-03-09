<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/8/2017
 * Time: 2:00 PM
 */

// local dev env
$router->define([
    '' => 'controllers/index.ctrl.php',
    'about' => 'controllers/about.ctrl.php',
    'about/culture' => 'controllers/about-culture.ctrl.php',
    'contact' => 'controllers/contact.php'
]);

// TODO: make a routes for production env
/*
$router->define([
    '' => 'controllers/index.ctrl.php',
    'about' => 'controllers/about.ctrl.php',
    'about/culture' => 'controllers/about-culture.ctrl.php',
    'contact' => 'controllers/contact.php'
]);
*/

//
