<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/6/2017
 * Time: 10:00 PM
 */

try {
    $queries = new QueryBuilder();
} catch ( Exception $e) {
    die ('there was an error connecting to the database');
}

require 'index.view.php';