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
     * @param array $toSelect Un array avec ce qu'on veut dedans... <o/
     * @return mixed
     */
    protected function select(Array $req){
        $sql = 'SELECT ';
        if(isset($req['fields'])){
            if(is_array($req['fields'])){
                $sql .= implode(', ', $req['fields']);
            }
            else{
                $sql .= $req['fields'];
            }
        }
        else{
            $sql .= "*";
        }

        if(isset($req['table'])){
            $sql .= " FROM ".$req['table'];
        }
        else{
             return false;
        }

        if(isset($req['where'])){
            $sql .= " WHERE ";
            if(!is_array($req['where'])){
                $sql .= $req['where'];
            }
            else{
                $where = [];
                foreach($req['where'] as $field => $value){
                    if(is_array($value)){
                        if(!is_numeric($value[1])){
                            $value[1] = '"'.mysql_escape_string($value[1]).'"';
                        }
                        $where[] = $field.' '.$value[0].' '.$value[1];
                        break;
                    }
                    elseif(!is_numeric($value)){
                        $value = '"'.mysql_escape_string($value).'"';
                        $where[] = $field.' LIKE '.$value;
                    }
                    else{
                        $where[] = $field.' = '.$value;
                    }
                }
                $sql .= implode(' AND ', $where);
            }
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}