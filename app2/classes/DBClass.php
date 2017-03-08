<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 11:35 PM
 */

class DBClass {
    private static $DB_CONNECTIONSTR = 'sqlite:/xampp/htdocs/angularjs-php/db/countries.db';
    private static $db = null;

    protected static function connect() {
        self::$db = new PDO(self::$DB_CONNECTIONSTR, '', '');
    }

    public static function execute ($sql, $values = array()) {
        if(self::$db === null) { // not connected to db
            self::connect();
        }

        $statement = self::$db->prepare($sql);
        $statement->execute($values);
        return $statement;
    }

    public static function query($sql, $values = array()) {
        $statement = self::execute($sql, $values);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
}