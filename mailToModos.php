#!/usr/bin/php
<?php

// definition de l'heure du serveur
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

define('DS', DIRECTORY_SEPARATOR);
define('VENDOR', '.'.DS.'vendor'.DS);
define('SYS','.'.DS.'system'.DS);
define('APP', '.'.DS.'app'.DS);


// Autoloader
spl_autoload_register(function( $class ) {
    $classFile = str_replace('\\', DS, $class);
    $classPI = pathinfo($classFile);
    // $classPI  ex: [dirname] => system [basename] => Config [filename] => Config
    $filename = strtolower($classPI[ 'dirname' ] . DS . $classPI[ 'filename' ] . '.php');
    if(file_exists($filename))
        include_once($filename);
});

// Charge la configuration du programme.
system\Config::load();

//Launch da funk to the space!
$procedure = new app\Procedure;

