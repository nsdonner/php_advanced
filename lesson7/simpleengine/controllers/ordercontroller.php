<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:51
 */

namespace simpleengine\controllers;

use simpleengine\models\Order;
use simpleengine\models\User;

class OrderController extends AbstractController
{

    public function actionIndex()
    {
        // показывать заказы текущего пользователя

        // если пользователь не залогинен, то переводить его на страницу авторизации

        $user = new User();
        $order = new Order();

        echo $this->render("/order", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "userOrders" => $order->getOrders($user->getId())

        ]);
    }

    public function actionAddproduct()
    {
    }

    public function actionOrder()  {


        $user = new User();
        $order = new Order();

        echo $this->render("/checkout", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "order" => $order->getOrder($user->getId())

        ]);



    }


    public function actionFind()
    {

        $user = new User();
        $order = new Order();

        echo $this->render("/find", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "order" => $order->getOrder($user->getId())

        ]);


    }

    public function actionAdmFind()
    {

        $user = new User();
        $order = new Order();

        echo $this->render("/admfind", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "order" => $order->getAdmOrder(),
            "isAdmin" => $user->getRoles(),

        ]);


    }

    public function actionRemoveOrder()
    {

        $user = new User();
        $order = new Order();
        $result = $order->removeOrder((int)($user->getId()));

        echo $this->render("/order", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "userOrders" => $order->getOrders($user->getId())

        ]);


    }


    public function actionRemoveFromOrder()
    {

        $user = new User();
        $order = new Order();
        $result = $order->removeFromOrder((int)($user->getId()));

        echo $this->render("/checkout", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "order" => $order->getOrder($user->getId())

        ]);


    }


    public function actionPay()
    {

        $user = new User();
        $order = new Order();
        $result = $order->payOrder((int)($user->getId()));

        echo $this->render("/order", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "userOrders" => $order->getOrders($user->getId())

        ]);


    }

    public function actionSave()
    {

        $user = new User();
        $order = new Order();
        $result = $order->save((int)($user->getId()));

        echo $this->render("/order", [
            "isAuth" => $user->userIsAuth(),
            "user" => $user->getFirstname(),
            "userOrders" => $order->getOrders($user->getId())

        ]);


    }



}