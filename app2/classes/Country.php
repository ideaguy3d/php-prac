<?php

/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 6:02 PM
 */

class Country {
    public $name; public $code; public $states;

    public function __construct($name = '', $code = '', $states = array()) {
        // TODO: implement validation.
        $this->name = $name;
        $this->code = $code;
        $this->states = $states;
    }
}