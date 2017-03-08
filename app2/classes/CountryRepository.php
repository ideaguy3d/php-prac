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

        // TODO: replace this hard coded data with queries to a MySQL database.
        array_push(
            $countries,
            new Country('America', 'us', array(new State('California'), new State('Maine')))
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

    public static function getStates($countryCode) {
        if(count(self::$countries) === 0) {
            self::init();
        }
        $country = array_filter(self::$countries, function($c) use ($countryCode) {
            return $c->code === $countryCode;
        });
        if(count($country) === 0) {
            return array();
        }
        $firstCountry = array_shift($country);
        return $firstCountry->states;
    }
}