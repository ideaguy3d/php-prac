<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/7/2017
 * Time: 8:12 AM
 */

class QueryBuilder {
    protected $jHostName;
    protected $jUserName;
    protected $jPassword;
    protected $jDatabase;
    protected $link = '';

    public function __construct($hostname = '', $username = '', $password = '', $database = '') {
        $this->jHostName = $hostname;
        $this->jUserName = $username;
        $this->jPassword = $password;
        $this->jDatabase = $database;
    }

    public function link2db() {

    }
}