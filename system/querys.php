<?php
/**
 * Created by PhpStorm.
 * User: anice_000
 * Date: 28/02/2015
 * Time: 20:16
 */

namespace system;
use system\Database;

class Querys {

    protected $pdo;

    /**
     * Récupération de PDO
     */
    protected function __CONSTRUCT(){
        $this->pdo = Database::getInstance();
    }

    /**
     * SELECT dans la base de donnée
     * @param $table Nom de la table
     * @param array $toSelect Un array de la liste des champs à récupérér
     * @return mixed
     */
    protected function select($table, Array $toSelect){
        $columns = implode(", ", $toSelect);
        $stmt = $this->pdo->prepare('SELECT '.$columns.' FROM '.$table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}