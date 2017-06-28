<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 27.06.2017
 * Time: 8:18
 */


namespace simpleengine\models;


class DefaultModel
{

    private function query($sql)
    {
        try {
            $dbh = new \PDO(DSN, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            echo "Error: Could not connect. " . $e->getMessage();
        }

        // установка error режима
        $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        try {

            $sth = $dbh->prepare($sql);
            $sth->execute();

            while ($result = $sth->fetch()) {
                $data[] = $result[0];
            }

        } catch (\PDOException $e) {
        }

        return $data;

    }

    public function testMethod()
    {
        $username = 'Гость';
        session_start();

        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['pass'];
            $sql = "SELECT COUNT(*) FROM `users` WHERE login= '" . $login . "' AND password = '" . $password . "'";

            $data = $this->query($sql);


            if ($data[0] > 0) {
                $_SESSION['username'] = $_POST['login'];
            } else {
                $username = 'хорошая попытка, но ты ввел не правильные данные.';
            }

        }

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        return "Привет, " . $username;
    }


    public function menu()
    {

        session_start();

        if (isset($_SESSION['username'])) {
            $menuList = ['Кабинет' => '/hello/hello', 'Выйти' => '/hello/bye'];

        } else $menuList = ['Войти' => '/hello/login'];

        return $menuList;
    }


}