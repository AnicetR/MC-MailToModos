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
            $modos = [];
            $request = "SELECT child, parent FROM $this->permissions_inheritance WHERE parent LIKE 'mod' OR parent LIKE 'jrmod'";

            foreach($this->query($request) as $modo){
                $child = $modo['child'];
                $request = "SELECT `value` FROM $this->permissions WHERE `name` LIKE ".'"'.$child.'"'." AND permission LIKE ".'"name"'; //#crado

                $datas = $this->query($request);
                if(!empty($datas))
                    $modos[] = [$datas[0]['value'], $modo['parent']];
            }

            $this->cache->set($this->modosCache, $modos);
            return $modos;
        }

    }

}