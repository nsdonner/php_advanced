<?php
/**
 * Created by PhpStorm.
 * User: Alex Pryakhin
 * Date: 18.04.2017
 * Time: 16:30
 */

namespace simpleengine\controllers;





class DefaultController extends AbstractController
{
    public function actionIndex()
    {


        $model = new \simpleengine\models\DefaultModel();
        $user = new \simpleengine\models\User();

        echo $this->render("index", [


            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "hello" => "geekbrains",
            "info" => $model->testMethod(),
            "username" => $user->userIsAuth(),
            "menuList" => $model->menu(),
            "usersItems" => $user->getUsersBasket(),
            "isAdmin" => $user->getRoles(),

        ]);
       
    }
}