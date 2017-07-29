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

                $sql = "SELECT id FROM `users` WHERE login= '" . $login . "' AND password = '" . $password . "'";
                $userId = $this->query($sql);

                echo '<pre>';
                var_dump($userId);
                echo '</pre>';

                $_SESSION['id'] = $userId[0][0];

            } else {
                $username = 'хорошая попытка, но ты ввел не правильные данные!';
            }

        }

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            $sql = "SELECT id FROM `users` WHERE login= '" . $login . "' AND password = '" . $password . "'";
            $userId = $this->query($sql);

            echo '<pre>';
            var_dump($userId);
            echo '</pre>';

            $_SESSION['id'] = $userId[0][0];



        }

        return "Привет, " . $username;
    }


    public function catalog()
    {
        try {
            $dbh = new \PDO(DSN, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            echo "Error: Could not connect. " . $e->getMessage();
        }

        $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        try {
            // формируем SELECT запрос
            // в результате каждая строка таблицы будет объектом
            $sql = "SELECT price AS price, name AS name, photo AS photo FROM goods WHERE active = 1";
            $sth = $dbh->query($sql);
            while ($row = $sth->fetchObject()) {
                $data[] = $row;
            }
        } catch (\PDOException $e) {
        }
        // закрываем соединение
        unset($dbh);
        return $data;
    }

    public function menu()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['username'])) {
            $menuList = ['Кабинет' => '/hello/hello', 'Выйти' => '/login/bye'];
        } else $menuList = ['Войти' => '/login/login'];





        return $menuList;
    }

    public function bye()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location:/');
        exit;
    }

    public function hello()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            return ['username' => $_SESSION['username']];
        } else {
            return ['guest' => '1'];
        }
    }
}