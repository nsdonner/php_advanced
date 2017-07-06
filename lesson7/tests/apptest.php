<?php
require(__DIR__ . "/../simpleengine/core/autoload.php");
require(__DIR__ . "/../vendor/autoload.php");


class AppTest extends \PHPUnit\Framework\TestCase{
    protected $app;

    protected function setUp(){
        // Подключаем конфигурацию
        $configuration = [];
        require(__DIR__ . "/../configuration/main.config.php");

        $this->app = simpleengine\core\Application::instance();
        $this->app->setConfiguration($configuration);
    }

    protected function tearDown(){
        // destroy test DB rows
    }

    public function testMain(){
        $this->assertEquals("PROD", $this->app->get("ENVIRONMENT"));
    }
}



