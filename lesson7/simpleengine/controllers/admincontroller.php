<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 30.07.2017
 * Time: 0:16
 */

namespace simpleengine\controllers;


class adminController extends AbstractController{

    function actionIndex(){



        $model = new \simpleengine\models\DefaultModel();
        $user = new \simpleengine\models\User();

        echo $this->render("index", [


            "isAuth" => $user->userIsAuth(),
            "isAdmin" => $user->getRoles(),
            "firstName" => $user->getFirstname(),

        ]);




    }


}

