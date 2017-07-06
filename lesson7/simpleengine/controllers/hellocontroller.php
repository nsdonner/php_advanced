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

    public function actionIndex()
    {
        $user = new User(1);
        echo $user->getEmail();
        $usersItems = $user->getUsersBasket();
        echo "<p>Ваша корзина</p>";
        echo "<ul>";
        foreach($usersItems as $item){
            echo "<li>".$item["product_name"].": ".$item["product_price"]." руб.</li>";
        }
        echo "</ul>";
    }
}