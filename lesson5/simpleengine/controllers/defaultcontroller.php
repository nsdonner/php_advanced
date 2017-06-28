<?php
/**
 * Created by PhpStorm.
 * User: Alex Pryakhin
 * Date: 18.04.2017
 * Time: 16:30
 */

namespace simpleengine\controllers;


use simpleengine\models\DefaultModel;

class DefaultController extends AbstractController
{
    public function actionIndex()
    {
        $model = new DefaultModel();

        echo $this->render("index", [
            "hello" => "geekbrains",
            "info" => $model->testMethod(),
            "menuList" => $model->menu(),

        ]);
    }
}