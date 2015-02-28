<?php
namespace system;
use system\Config;

class Cache {

    public $activated;
    public $path;
    public $time; // en secondes

    /**
     * @param $path Chemin complémentaire du cache
     * @param int $time Temps à cacher
     */
    function __construct($path, $time = 10)
    {
        $this->path = DS.APP.'cache'.DS.$path;
        $this->time = $time;
        $this->activated = Config::$application['enable_cache'];
    }

    /**
     * Définition d'un cache
     * @param $filename Nom du cache
     * @param $content $value Valeurs à entrer dans le cache
     */
    public function set($filename, Array $content)
    {
        if($this->activated)
            file_put_contents($this->path.$filename.'.json', json_encode($content));
    }

    /**
     * Récupération du cache
     * @param $filename Nom du cache
     * @return bool|mixed Le cache
     */
    public function get($filename)
    {
        if($this->activated){
            $filename = $this->path.$filename.'.json';
            if($this->cached($filename))
                return json_decode(file_get_contents($filename));
            return false;
        }
        return false;

    }

    /**
     * teste si le cache existe
     * @param $filename
     * @return bool
     */
    public function cached($filename)
    {
        if(file_exists($filename) && (filemtime($filename) + $this->time >= time()))
            return true;
        return false;
    }
}