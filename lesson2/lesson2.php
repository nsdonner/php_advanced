<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 18.06.2017
 * Time: 18:05
 */

abstract class Goods{

    public static $basePrice;
    protected $price;
    public $name;

    function sell(){
        echo $this->name .' продан за '. $this->price . '<br>';
    }


}

class Eproduct extends Goods {

    function __construct()
    {
        $this->name=__CLASS__;
        $this->price=parent::$basePrice / 2;
    }
 }


class Product extends Goods{



    function __construct()
    {
        $this->name=__CLASS__;
        $this->price=parent::$basePrice;
    }

}

class Weighty extends Goods{

    function __construct($weight)
    {
        $this->name=__CLASS__;
        $this->price=parent::$basePrice*$weight;
    }

}

Goods::$basePrice=20;

$a = new Eproduct();
$b = new Product();
$c = new Weighty(5);


$a->sell();
$b->sell();
$c->sell();


/*п.2 стырил с http://diomer.ru/read/design-pattern-singleton/ */


trait Singleton_Trait {
    private static $instance = null;

    // Защищаем от создания второго экземпляра
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    // Инициализация объекта или возвращение ранее созданного
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

class Foo {
    use Singleton_Trait;

    private $bar = 0;

    public function incBar() {
        $this->bar++;
    }

    public function getBar() {
        return $this->bar;
    }
}
// Применение

$foo = Foo::getInstance();
$foo->incBar();
$foo->incBar();
var_dump($foo->getBar());

$boo = Foo::getInstance();
$boo->incBar();

var_dump($foo->getBar());
var_dump($boo->getBar());