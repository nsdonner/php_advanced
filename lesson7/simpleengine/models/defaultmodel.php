<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26.06.2017
 * Time: 21:23
 */

namespace simpleengine\models;

use \simpleengine\core\Application;

class DefaultModel
{
    public function testMethod(){
        $app = Application::instance();
        $app->db()->getArrayBySqlQuery("SELECT * FROM users");

        return "GeekUnivercity is awesome";
    }


    public function menu()
    {
        /*if (!isset($_SESSION)) {
            session_start();
        }*/
        if (isset($_SESSION['email'])) {
            $menuList = ['Кабинет' => '/hello/hello', 'Выйти' => '/user/bye'];
        } else $menuList = ['Войти' => '/user/login'];

        return $menuList;
    }



}