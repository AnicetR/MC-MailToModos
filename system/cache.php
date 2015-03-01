<?php
namespace system;
use system\Config;
use system\Log;

class Cache {

    public $activated;
    public $path;
    public $time; // en secondes

    /**
     * @param $path Chemin complémentaire du cache
     * @param int $time Temps à cacher en minutes
     */
    function __construct($path, $time = 10)
    {
        $this->activated = Config::$app['enable_cache'];
        $this->path = APP.'cache'.DS.$path.DS;
        $this->time = $time*60;

        if($this->activated){

            if(!is_dir($this->path)) {
                if (mkdir($this->path, 0755))
                    Logs::write('Cache', 'Succes', 'Le dossier ' . $this->path . ' a bien été créé');
                else
                    Logs::write('Cache', 'Erreur', 'Le dossier ' . $this->path . ' n\'a pas pu être créé');
            }
        }
    }

    /**
     * Définition d'un cache
     * @param $filename Nom du cache
     * @param $content $value Valeurs à entrer dans le cache
     */
    public function set($filename, Array $content)
    {
        if($this->activated)
            if(file_put_contents($this->path.$filename.'.json', json_encode($content)))
                Logs::write('Cache','Succes', 'Le cache '.$filename.'.json a bien été créé');
            else
                Logs::write('Cache','Erreur', 'Le cache '.$filename.'.json n\'a pas pu être créé');
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
                return json_decode(file_get_contents($filename), true);
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