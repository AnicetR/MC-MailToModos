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
        if(Config::$app['enable_logs']){
            $path = APP.DS.'logs'.DS.$file.'.log';
            $line = '['.$type.'] '.date('d/m/Y H:i:s').' : '.$line."\r\n";
            self::printLog($file,$type,$line);
            return file_put_contents($path, $line, FILE_APPEND);
        }
        else
            return true;
    }

    public static function printLog($file, $type,$line){
        if(Config::$app['verbose']){
            print "[".strToUpper($file)."]";
            switch($type){
                case 'Succes':
                    print chr(27).'[0;32m'.$line.chr(27).'[0m';
                    break;
                case 'Info':
                case 'Infos':
                case 'Dev':
                    print chr(27).'[1;33m'.$line.chr(27).'[0m';
                    break;
                case 'Erreur':
                    print chr(27).'[0;31m'.$line.chr(27).'[0m';
                    break;
                default:
                    print chr(27).'[1;37m'.$line.chr(27).'[0m';
                    break;
            }
        }
    }


}
