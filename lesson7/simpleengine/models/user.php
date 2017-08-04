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
    private $id = 0;

    /**
     * @return mixed
     */
    public function getId()
    {

        return $this->id;

    }

    private $firstname;
    private $lastname;
    private $middlename;
    private $email;
    private $roles;

    /**
     * @return mixed
     */

    public function __construct($id = null)
    {

        if (isset($_SESSION['id'])) {
            $id = $this->id = (int)($_SESSION['id']);

        }


        if ((int)($id) > 0) {
            $this->find($id);
        }
    }

    public function bye()
    {
        /* session_start();*/
        session_unset();
        session_destroy();
        header('Location:/');
        exit;
    }


    public function userIsAuth()
    {

        /*session_start();*/
        $username[0] = 'Гость';
        $username[1] = 0;

        if (isset($_POST['email'])) {
            $app = Application::instance();
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $sql = "SELECT * FROM users WHERE email=? AND hash_pass = MD5(?)";
            $sqlData = [$email,$password];

            $data = $app->db()->getArrayBySqlQuery($sql,$sqlData);

            if (isset($data[0]['id'])) {




                $_SESSION['email'] = $_POST['email'];
                $_SESSION['id'] = $data[0]['id'];
                $username[0] = $data[0]['firstname'];
                $_SESSION['username'] = $data[0]['firstname'];
                $this->find($data[0]['id']);



            } else {
                $username[0] = 'Хорошая попытка, но ты ввел неправильные данные.';
                $username[1] = 0;
            }
        }

        if (isset($_SESSION['username'])) {
            $username[0] = $_SESSION['username'];
            $username[1] = 1;
           /* $_SESSION['id'] = $data[0]['id'];*/

        }

        return $username;

    }

    public function auth()
    {

    }


    public function find($id)
    {
        $app = Application::instance();
        $sql = "SELECT * FROM users WHERE id =?";
        $sqlData = [(int)$id];
        $result = $app->db()->getArrayBySqlQuery($sql,$sqlData);



        if (isset($result[0])) {
            $this->id = $result[0]["id"];
            $this->roles = $result[0]["is_admin"];
            $this->firstname = $result[0]["firstname"];
            $this->lastname = $result[0]["lastname"];
            $this->middlename = $result[0]["middlename"];
            $this->email = $result[0]["email"];
            $this->roles = $result[0]["is_admin"];

        }
    }


    public
    function getUsersBasket()
    {
        if (isset($_SESSION['id'])) {

            $this->id = $_SESSION['id'];
            $basket = new Basket($this->id);

        } else $basket = new Basket($this->id);
        return $basket->getProductsArray();
    }

    public
    function save($userid)
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

    public function getRoles()
    {
        return $this->roles;
    }
}