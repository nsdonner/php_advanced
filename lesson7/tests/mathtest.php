<?php
require_once("../simpleengine/models/math.php");

class MathTest extends \PHPUnit\Framework\TestCase
{
    public function providerFactorial(){
        return [
            [0, 1],
            [2, 2],
            [5, 120]
        ];
    }

    public function providerNumbers(){
        return [
            [4], [18]
        ];
    }

    /**
     * @dataProvider providerFactorial
     */
    public function testFactorial($number, $expected){
        $this->assertEquals($expected, \simpleengine\models\Math::factorial($number));
    }

    /**
     * @dataProvider providerNumbers
     */
    public function testIsEven($number){
        $math = new \simpleengine\models\Math();
        $this->assertTrue($math->isEven($number));
    }
}