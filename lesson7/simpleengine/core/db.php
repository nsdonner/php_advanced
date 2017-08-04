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
            $pdoAttributes = array();
            $pdoAttributes[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_WARNING;
            $this->pdo = new \PDO($dsn, $user, $pass, $pdoAttributes );
        }
        catch(\PDOException $e){
            echo "Can't connect to database";
        }
    }

    public function getArrayBySqlQuery(string $sql, array $data=[]){


        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
            /*$statement = $this->pdo->query($sql); */
            $result = $statement->fetchAll();
            $err=$statement->errorInfo();

            if ($err[2] != null) {


                echo '<pre>';
                var_dump('PREPARE = ',$statement->queryString);
                echo '</pre>';

                echo '<pre>';
                var_dump($err[2]);
                echo '</pre>';


                $result['err'] = $err[2];
            }

        } catch (\PDOException $e){

            $result = $e;
            echo $e;

        }

        return $result;
    }
}