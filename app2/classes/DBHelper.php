<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 11:32 PM
 */

require_once 'DBClass.php';
require_once 'Country.php';
require_once 'State.php';

class DBHelper
{
    public static function resetDB() {
        DBClass::execute('
            create table countries (name VARCHAR (50), 
            code VARCHAR (10) PRIMARY KEY)
        ');

        DBClass::execute('create table states (name VARCHAR (50), code VARCHAR (10))');
    }
}

//

