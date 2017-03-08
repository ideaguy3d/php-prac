<?php

/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 6:06 PM
 */

require 'Country.php';
require 'State.php';

class CountryRepository
{
    private static $countries = array();

    protected static function init() {
        $countries = array();
        array_push(
            $countries,
            new Country('America', 'us', array(new State('California'), new State('Texas')))
        );
        array_push(
            $countries,
            new Country('Canada', 'ca', array(new State('Ontario'), new State('Quebec')))
        );
        array_push(
            $countries,
            new Country('Luxembourg', 'lu')
        );
        self::$countries = $countries;
    }

    public static function getCountries() {
        if(count(self::$countries) === 0) {
            self::init();
        }
        return self::$countries;
    }
}