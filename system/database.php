<?php
/**
 * Code de gotha modifié pour l'occas'
 */

namespace system;
use \PDO;

class Database{
    /**
     * @var  variable statique de l'instace de la pdo
     */
    private static $instance;

    /**
     * Permet de recuperer l'instance PDO
     */
    public static function getInstance($db = 0)
    {
        if (!isset(self::$instance))
        {
            try
            {
                $info = Config::$database[$db];
                self::$instance = new PDO( $info['driver'].":dbname=". $info['database'].";host=". $info['host'], $info['user'], $info['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                if(Config::$app['environment'] == "development")
                    die('Connection failed: '. $e->getMessage());
                else
                    die('Impossible de se connecter à la base de donnée');
            }
        }

        return self::$instance;
    }
}