<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 19:15
 */

namespace simpleengine\core;

use \simpleengine\core\Application;

class Db
{
    private $pdo;

    public function __construct(string $connection_name = "DB"){
        $app = Application::instance();

        try{
            $pass = $app->get($connection_name)["DB_PASS"];
            $user = $app->get($connection_name)["DB_USER"];
            $name = $app->get($connection_name)["DB_NAME"];
            $host = $app->get($connection_name)["DB_HOST"];
            $charset = $app->get($connection_name)["DB_CHARSET"];
            $dsn = 'mysql:dbname='.$name.';host='.$host.";charset=".$charset;

            $this->pdo = new \PDO($dsn, $user, $pass);
        }
        catch(\PDOException $e){
            echo "Can't connect to database";
        }
    }

    public function getArrayBySqlQuery(string $sql){
        $statement = $this->pdo->query($sql);
        $result = $statement->fetchAll();

        return $result;
    }
}