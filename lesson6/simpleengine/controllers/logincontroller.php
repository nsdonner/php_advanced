<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 02.07.2017
 * Time: 19:55
 */


namespace simpleengine\controllers;

use simpleengine\models\DefaultModel;

class LoginController extends AbstractController
{

    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
        echo __CLASS__;
    }


    public function actionLogin()
    {
        // TODO: Implement actionIndex() method.


        echo $this->render("/loginpage");



    }

    public function actionBye()
    {
        // TODO: Implement actionIndex() method.

       $model = new DefaultModel();
       $model->bye();

    }



}