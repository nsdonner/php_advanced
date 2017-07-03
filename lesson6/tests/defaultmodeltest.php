<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 03.07.2017
 * Time: 19:03
 */
require_once("../simpleengine/models/defaultmodel.php");

const DB_HOST = '172.29.0.250';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'lesson6';
const DB_CHARSET = 'utf8';
const DSN = 'mysql:dbname='.DB_NAME.';charset='.DB_CHARSET.';host='.DB_HOST.'';

class defaultModelTest extends \PHPUnit\Framework\TestCase
{

    public function testCatalog(){



        $model = new simpleengine\models\DefaultModel();
        $this->assertArrayHasKey('0', $model->catalog() );
        $this->assertArrayHasKey('1', $model->catalog() );
        $this->assertArrayHasKey('2', $model->catalog() );
        $this->assertArrayHasKey('3', $model->catalog() );
        $this->assertArrayHasKey('4', $model->catalog() );
    }


}