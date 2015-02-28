<?php

namespace system;

class Config{

    public static $app = array();
    public static $database   = array();
    public static $server = array();

    public static $dynamic = array();

    /**
     * Récupération de la config
     */
    public static function load()
    {
        self::$app = require APP.'config'.DS.'app.php';
        self::$database = require APP . 'config' . DS . 'database.php';
        self::$server = require APP.'config'.DS.'server.php';
    }
}