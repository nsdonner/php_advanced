<?php
/**
 * Created by PhpStorm.
 * User: Alex Pryakhin
 * Date: 18.04.2017
 * Time: 17:37
 */

namespace simpleengine\controllers;


use simpleengine\models\User;

class HelloController extends AbstractController
{


    public function actionAdd(){

        $user = new User();
        $basket = new \simpleengine\models\Basket();
        $basket->addToBasket();


        echo $this->render("/hello", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "usersItems" => $user->getUsersBasket()

        ]);

    }


    public function actionRemove(){

        $user = new User();
        $basket = new \simpleengine\models\Basket();
        $basket->removeFromBasket();


        echo $this->render("/hello", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "usersItems" => $user->getUsersBasket()

        ]);

    }


    public function actionOrder(){

        $user = new User();
        $basket = new \simpleengine\models\Basket();
        $basket->removeFromBasket();


        echo $this->render("/hello", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "usersItems" => $user->getUsersBasket()

        ]);

    }


    public function actionIndex()
    {
        $user = new User();
        echo $this->render("/hello", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "usersItems" => $user->getUsersBasket()

        ]);
    }



}