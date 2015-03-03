<?php
/**
 * Created by PhpStorm.
 * User: anice_000
 * Date: 28/02/2015
 * Time: 20:16
 */

namespace system;
use system\Database;
use \PDO;
class SQLQueries {

    protected $pdo;

    /**
     * Récupération de PDO
     */
    function __CONSTRUCT(){
        $this->pdo = Database::getInstance();
    }

    /**
     * Fuck l'abstraction, FullSQL for life motherfucker
     * @param $req
     * @return array|bool
     */

    protected function query($req){
        $stmt = $this->pdo->prepare($req);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
//    protected function select($req){
//        $sql = 'SELECT ';
//        if(isset($req['fields'])){
//            if(is_array($req['fields'])){
//                $sql .= implode(', ', $req['fields']);
//            }
//            else{
//                $sql .= $req['fields'];
//            }
//        }
//        else{
//            $sql .= "*";
//        }
//
//        if(isset($req['table'])){
//            $sql .= " FROM ".$req['table'];
//        }
//        else{
//             return false;
//        }
//
//        if(isset($req['where'])){
//            $sql .= " WHERE ";
//            $whereor = 0;
//            $whereand = 0;
//
//            if(!is_array($req['where'])){
//                $sql .= $req['where'];
//            }
//            else{
//                if(array_key_exists(0, $req['where']) ){
//                    if($req['where'][0] == 'OR'){
//                        $whereor = 1;
//                        $req['where'] = $req['where'][1];
//                    }
//                    elseif($req['where'][0] == 'AND') {
//                        $whereand = 1;
//                        $req['where'] = $req['where'][1];
//                    }
//                }
//                $where = [];
//                foreach($req['where'] as $field => $value){
//                    if(is_array($value)){
//                        if(!is_numeric($value[1])){
//                            $value[1] = '"'.mysql_escape_string($value[1]).'"';
//                        }
//                        $where[] = $field.' '.$value[0].' '.$value[1];
//                        break;
//                    }
//                    elseif(!is_numeric($value)){
//                        $value = '"'.mysql_escape_string($value).'"';
//                        $where[] = $field.' LIKE '.$value;
//                    }
//                    else{
//                        $where[] = $field.' = '.$value;
//                    }
//                }
//                if($whereand)
//                    $sql .= implode(' AND ', $where);
//                elseif($whereor)
//                    $sql .= implode(' OR ', $where);
//                else
//                    $sql .= $where[0];
//            }
//        }




}