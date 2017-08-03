<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 30.07.2017
 * Time: 0:16
 */

namespace simpleengine\controllers;

use simpleengine\models\Order;
use simpleengine\models\Product;
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



    function actionAdd(){



        $product = new Product();
        $product->add();
        $user = new User();



        echo $this->render("catalog", [

            "isAuth" => $user->userIsAuth(),
            "isAdmin" => $user->getRoles(),
            "firstName" => $user->getFirstname(),
            "deleted" => $product->getDeleted(),
            "categories" => $product->getCatalog(),
            "status" => $product->getStatus(),
            "catalog" => $product->getAllProducts(),

        ]);

    }

    function actionProducts()
    {

        $user = new User();
        $product = new Product();


        echo $this->render("catalog", [


            "isAuth" => $user->userIsAuth(),
            "isAdmin" => $user->getRoles(),
            "firstName" => $user->getFirstname(),
            "catalog" => $product->getAllProducts(),
            "deleted" => $product->getDeleted(),
            "categories" => $product->getCatalog(),


        ]);

    }

    function actionRmProduct(){

        $user = new User();
        $product = new Product();
        $product->rmProduct();

        echo $this->render("catalog", [


            "isAuth" => $user->userIsAuth(),
            "isAdmin" => $user->getRoles(),
            "firstName" => $user->getFirstname(),
            "catalog" => $product->getAllProducts(),
            "deleted" => $product->getDeleted(),
            "categories" => $product->getCatalog(),


        ]);


    }


    function actionRmGroup(){

        $user = new User();
        $product = new Product();
        $product->rmGroup();

        echo $this->render("catalog", [


            "isAuth" => $user->userIsAuth(),
            "isAdmin" => $user->getRoles(),
            "firstName" => $user->getFirstname(),
            "catalog" => $product->getAllProducts(),
            "deleted" => $product->getDeleted(),
            "categories" => $product->getCatalog(),


        ]);


    }

}
