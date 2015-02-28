<?php

namespace system;

class Config{

    public static $application = array();
    public static $database   = array();
    public static $server = array();

    public static $dynamic = array();

    /**
     * Récupération de la config
     */
    public static function load()
    {
        self::$application = require APP.'config'.DS.'application.php';
        self::$database = require APP . 'config' . DS . 'database.php';
        self::$server = require APP.'config'.DS.'server.php';
    }
}