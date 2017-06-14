<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 14.06.2017
 * Time: 22:17
 */

ini_set('display_errors','On');
error_reporting('E_ALL');

/*
1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.
2. Описать свойства класса из п.1 (состояние)
3. Описать поведение класса из п.1 (методы).
4. Придумать наследников класса из п.1. Чем они будут отличаться?
*/



class Goods {

    public $productGroupId;
    public $brand;
    public $price;
    public $promo=0;
    public $color;

    function setPromo($promo=1){
        $this->promo=$promo;
    }

    function viewGoods(){

        echo "Товар типа '" . $this->productGroupId . "' фирмы " . $this->brand . " стоит " . $this->price . ", цвет " . $this->color. ($this->promo==1?'по акции':'') ."<br>";
    }


}

class Product extends Goods {

    public $productSerialNumber;
    public $store;
    /*function sell(){
        unset($this);
    }*/




    function __construct($productGroupId,$brand,$price,$color,$productSerialNumber,$store)
    {
        $this->productGroupId = $productGroupId;
        $this->brand = $brand;
        $this->price = $price;
        $this->color = $color;
        $this->productSerialNumber = $productSerialNumber;
        $this->store = $store;

    }

    function viewProduct(){
        $this->viewGoods();
        echo "S/N". $this->productSerialNumber . ' ' . $this->store . "<br>";
    }

}

$tshort = new Product('футболки',"Lacost","10 euro","красный","12345678","основной склад");
$tshort->viewProduct();

/*5. Дан код
Что он выведет на каждом шаге? Почему?*/


class A {
    public function foo() {
        static $x = 0;
        echo ++$x .'<br>';
    }
}

$a1 = new A();
$a2 = new A();

$a1->foo();// 1
$a2->foo();// 2
$a1->foo();// 3
$a2->foo();// 4  т.к. переменная x статическая, а статические переменные - зло.




class C {
    public function foo() {
        static $x = 0;
        echo ++$x .'<br>';
    }
}

class B extends C {
}

$a1 = new C();
$b1 = new B();

$a1->foo();// 1
$b1->foo();// 1
$a1->foo();// 2
$b1->foo();// 2 Исходя из статьи https://habrahabr.ru/post/301478/ - op_array создаёт дубликат функции при наследовании методов со статическими переменными.
