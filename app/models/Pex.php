<?php
/**
 * Created by PhpStorm.
 * User: anice_000
 * Date: 01/03/2015
 * Time: 17:41
 */

namespace app\models;
use system\SQLQueries;
use system\Config;
use system\Cache;
use system\Logs;

class Pex extends SQLQueries{
    private $permissions = 'permissions';
    private $permissions_inheritance = 'permissions_inheritance';
    private $modosCache = "modos";
    private $cache;

    public function __CONSTRUCT(){
        parent::__CONSTRUCT();
        $this->cache = new Cache('pex', (Config::$app['permissions_refresh_rate']*60));
    }

    public function getModos(){

        Logs::write('Pex', 'Info', 'Récupération de la liste des modérateurs');

        if($this->cache->cached($this->modosCache))
            return $this->cache->get($this->modosCache);

        else{
            $request = "SELECT p.value AS `name`, pi.parent AS `role`
                        FROM $this->permissions_inheritance AS pi
                        LEFT JOIN $this->permissions AS p
                        ON (pi.child = p.name  AND p.permission LIKE 'name')
                        WHERE (pi.parent LIKE 'mod' OR pi.parent LIKE 'jrmod') AND p.value IS NOT NULL
                        ";
            $modos = $this->query($request);
            $this->cache->set($this->modosCache, $modos);
            return $modos;
        }

    }

}