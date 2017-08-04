<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26.06.2017
 * Time: 21:23
 */

namespace simpleengine\models;



class DefaultModel
{
    public function testMethod()
    {


        return "GeekUnivercity is awesome";
    }


    public function menu()
    {
        /*if (!isset($_SESSION)) {
            session_start();
        }*/
        if (isset($_SESSION['email'])) {
            $menuList = [   'Каталог' => '/product/index',
                            'Кабинет' => '/hello',
                            'Выйти' => '/user/bye'
            ];
        } else $menuList = ['Войти' => '/user/login',
                            'Каталог' => '/product/index'
            ];



        return $menuList;
    }


}