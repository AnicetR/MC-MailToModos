<?php
/**
 * Created by PhpStorm.
 * User: anice_000
 * Date: 28/02/2015
 * Time: 22:50
 */

namespace app\models;
use vendor\xPaw\MinecraftQuery;
use vendor\xPaw\MinecraftQueryException;
use system\Logs;
use system\Cache;
use system\Config;

class Queries extends MinecraftQuery{
    private $host, $port;

    public function __construct($host, $port){
        if(!filter_var($host, FILTER_VALIDATE_IP))
            $host = $this->DNSLookup($host);

        $this->host = $host;
        $this->port = $port;

        try{
            $this->Connect($this->host, $this->port);
            Logs::write('Queries', 'Info', "Query OK! Récupérations des infos...");
            $this->getServerInfos();
            $this->getPlayersList();
        }
        catch(MinecraftQueryException $e){
            Logs::write('Queries', 'Error', $e->getMessage());
            return;
        }
    }

    public function getServerInfos(){
        $cacheFile = 'serverInfos';

        $cache = new Cache('queries', Config::$app['query_refresh_rate']);
        if(!$cache->cached($cacheFile)){
            $serverInfos = $this->getInfo();
            $cache->set($cacheFile, $serverInfos);
            return $serverInfos;
        }
        else
            return $cache->get($cacheFile);
    }

    public function getPlayersList(){
        $cacheFile = 'playersList';

        $cache = new Cache('queries', Config::$app['query_refresh_rate']);
        if(!$cache->cached($cacheFile)){
            $playersList = $this->getPlayers();
            $cache->set($cacheFile, $playersList);
            return $playersList;
        }
        else
            return $cache->get($cacheFile);
    }



    private function DNSLookup($DNS){

        $result = dns_get_record('_minecraft._tcp.' . $DNS, DNS_SRV);
        if (count($result) > 0) {
            if (array_key_exists('target',$result[0])) $DNS = $result[0]['target'];
        }

        $result = dns_get_record($DNS, DNS_A);

        if (count($result) > 0 && array_key_exists('ip',$result[0]))
            return $result[0]['ip'];
        else
            return '127.0.0.1';
    }

}