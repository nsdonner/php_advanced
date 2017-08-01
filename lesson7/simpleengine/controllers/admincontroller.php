<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 30.07.2017
 * Time: 0:16
 */

namespace simpleengine\controllers;

use simpleengine\models\Order;
use simpleengine\models\User;


class adminController extends AbstractController
{

    function actionIndex()
    {


        $user = new User();

        echo $this->render("index", [


            "isAuth" => $user->userIsAuth(),
            "isAdmin" => $user->getRoles(),
            "firstName" => $user->getFirstname(),

        ]);


    }


    function actionOrders()
    {

        $user = new User();
        $order = new Order();
        $order->deliverOrder();

        echo $this->render("orders", [


            "isAuth" => $user->userIsAuth(),
            "isAdmin" => $user->getRoles(),
            "firstName" => $user->getFirstname(),
            "orders" => $order->getAllOrders(),


        ]);

    }

}
