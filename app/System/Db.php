<?php
namespace App\System;

use \Config;
use \PDO;

class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $config = Config::get('db');
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] , $config['username'], $config['password'], $pdo_options);
        }
        return self::$instance;
    }
}