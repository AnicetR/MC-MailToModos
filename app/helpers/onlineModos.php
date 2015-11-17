<?php

namespace app\helpers;
use system\Cache;
use system\Config;

class onlineModos{
    static $playersOnline,
            $modos,
            $cacheQueries,
            $cachePex;

    public static function get(){
        //Init
        self::$cachePex = new Cache('pex', (Config::$app['permissions_refresh_rate']*60));
        self::$cacheQueries = new Cache('queries', Config::$app['query_refresh_rate']);
        self::$modos = self::$cachePex->get('modos');
        self::$playersOnline = self::$cacheQueries->get('playersList');

        $modosList = [];

        //Let's do this!
        foreach(self::$modos as $modo){
            $modo = array_search($modo['name'], self::$playersOnline);
            if($modo){
                $modosList[] = $modo;
            }
        }
        print_r($modosList);
    }
}