<?php
require_once("mathtest.php");

class MyTestSuite extends \PHPUnit\Framework\TestSuite{
    public static function suite(){
        $suite = new MyTestSuite("TetsSet");
        $suite->addTestSuite('MathTest');
        return $suite;
    }
}