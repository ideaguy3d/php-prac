<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 9:50 PM
 */

require '../classes/CountryRepo.php';
echo ")]}'\n";

if (isset($_GET['countryCode']) && is_string($_GET['countryCode'])) {
    $states = CountryRepository::getStates($_GET['countryCode']);
    echo json_encode($states);
}


