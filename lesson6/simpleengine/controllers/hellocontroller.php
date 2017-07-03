<?php
/**
 * Created by PhpStorm.
 * User: Alex Pryakhin
 * Date: 18.04.2017
 * Time: 17:37
 */

namespace simpleengine\controllers;

use simpleengine\models\DefaultModel;

class HelloController extends AbstractController
{

    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
        echo __CLASS__;
    }




    public function actionHello()
    {
        // TODO: Implement actionIndex() method.


        $model = new DefaultModel();
        echo $this->render("/cabinet", $model->hello());





    }


}