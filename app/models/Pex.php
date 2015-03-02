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
            $request = [
                'fields' => 'child',
                'table' => $this->permissions_inheritance,
                'where' => ['parent' => ['LIKE', 'mod']],
            ];

            foreach($this->select($request) as $modo){
                $request = [
                    'fields' => 'value',
                    'table' => $this->permissions,
                    'where' => ['name' => $modo['child'], 'permission' => 'name'],
                ];
                $datas = $this->select($request);
                if(!empty($datas))
                    $modos[] = $datas[0]['value'];
            }

            $this->cache->set($this->modosCache, $modos);
            return $modos;
        }

    }

}