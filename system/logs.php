<?php
/**
 * Created by PhpStorm.
 * User: anice_000
 * Date: 28/02/2015
 * Time: 19:25
 */

namespace system;
use system\Config;

class Logs{

    /**
     * Ecrit dans les logs
     * @param $file : Nom du fichier de log dans lequel écrire
     * @param $type : Le type de log
     * @param $line : Texte à ajouter dans le log
     * @return bool|int
     */
    public static function write($file, $type, $line){
        if(Config::$application['enable_logs']){
            $path = APP.DS.'logs'.DS.$file.'.log';
            $line = '['.$type.'] '.date('j/m/d h:m:s').' : '.$line.'\r\n';
            return file_put_contents($path, $line, FILE_APPEND);
        }
        else
            return true;
    }


}