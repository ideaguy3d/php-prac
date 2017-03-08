<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 5:46 PM
 */

$countries = [
    ['name' => 'Austria'],
    ['name' => 'Canada']
];

$json = json_encode($countries);

var_dump(json_decode($json));

//