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
    }

    // gb.local/product/item/?id_product=123
    // gb.local/product/item/123/
    public function actionItem(){
        // карточка товара
    }
}