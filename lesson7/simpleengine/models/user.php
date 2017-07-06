<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 19:48
 */

namespace simpleengine\models;

use simpleengine\core\Application;

class User implements DbModelInterface
{
    private $id;
    private $firstname;
    private $lastname;
    private $middlename;
    private $email;

    public function __construct($id = null)
    {
        if ((int)$id > 0) {
            $this->find($id);
        }
    }

    public function bye()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location:/');
        exit;
    }


    public function userIsAuth()
    {

        session_start();
        $username = 'Гость';

        if (isset($_POST['email'])) {
            $app = Application::instance();
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $sql = "SELECT * FROM users WHERE email= '" . $email . "' AND hash_pass = MD5('" . $password . "')";
            $data = $app->db()->getArrayBySqlQuery($sql);

            if (isset($data[0]['id'])) {
                $_SESSION['email'] = $_POST['email'];
                $username = $data[0][firstname];
                $_SESSION['username'] = $data[0][firstname];
            } else {
                $username = 'хорошая попытка, но ты ввел не правильные данные.';
            }
        }

        if (isset($_SESSION['username'])){
            $username = $_SESSION['username'];
        }

        return "Привет, " . $username;

    }

    public function auth()
    {

    }

    public function find($id)
    {
        $app = Application::instance();
        $sql = "SELECT * FROM users WHERE id = " . (int)$id;
        $result = $app->db()->getArrayBySqlQuery($sql);

        if (isset($result[0])) {
            $this->id = $result[0]["id"];
            $this->firstname = $result[0]["firstname"];
            $this->lastname = $result[0]["lastname"];
            $this->middlename = $result[0]["middlename"];
            $this->email = $result[0]["email"];
        }
    }

    public
    function getUsersBasket()
    {
        $basket = new Basket($this->id);
        return $basket->getProductsArray();
    }

    public
    function save()
    {
        // TODO: Implement save() method.
    }

    /**
     * @return string firstname
     */
    public
    function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string lastname
     */
    public
    function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string middlename
     */
    public
    function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * @return string email
     */
    public
    function getEmail()
    {
        return $this->email;
    }
}