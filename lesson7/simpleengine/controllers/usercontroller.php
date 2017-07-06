<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:48
 */

namespace simpleengine\controllers;


class UserController extends AbstractController
{

    public function actionIndex()
    {

    }

    public function actionLogin()
    {
        // TODO: Implement actionIndex() method.


        echo $this->render("/loginpage");



    }

    public function actionBye()
    {
        // TODO: Implement actionIndex() method.

        $user = new \simpleengine\models\User();
        $user->bye();

    }


}