<?php
/**
 * Created by PhpStorm.
 * User: Alex Pryakhin
 * Date: 18.04.2017
 * Time: 17:37
 */

namespace simpleengine\controllers;


class HelloController extends AbstractController
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

        session_start();
        session_unset();
        session_destroy();
        header('Location:/');
        exit;


    }


    public function actionHello()
    {
        // TODO: Implement actionIndex() method.

        session_start();

        if (isset($_SESSION['username'])){

            echo $this->render("/cabinet",[
                'username' => $_SESSION['username']
                ]);

        } else {
            echo $this->render("/cabinet",[
                'guest' => '1'
            ]);
        }


    }


}