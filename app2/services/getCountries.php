<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 7:45 PM
 */
require '../classes/CountryRepo.php';

header('Content-type: application/json');
echo ")]}'\n"; // to prevent json hijacking.

$countries = CountryRepository::getCountries();

echo json_encode($countries);

//