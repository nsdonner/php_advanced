<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:49
 */

namespace simpleengine\controllers;


class ProductController extends AbstractController
{

    // gb.local/product/index/
    public function actionIndex()
    {
        // выводить каталог продуктов

        $product = new \simpleengine\models\Product();
        $user = new \simpleengine\models\User();

        echo $this->render("/catalog", [
            "catalog" => $product->getCatalog(''),
            "usersItems" => $user->getUsersBasket(),
            "isAuth" => $user->userIsAuth(),
        ]);





    }

    // gb.local/product/item/?id_product=123
    // gb.local/product/item/123/
    public function actionItem(){
        // карточка товара
        $id = (int)$_GET['product_id'];
        $product = new \simpleengine\models\Product('10',$id);
        $user = new \simpleengine\models\User();


        echo $this->render("/product", [

            "product" => $product->getProduct(),
            "usersItems" => $user->getUsersBasket(),
            "isAuth" => $user->userIsAuth(),

        ]);
    }




}