<?php
namespace simpleengine\core;

use simpleengine\core\exception\ApplicationException;

class Application {
    use Singleton;

    private $router;
    private $configuration = [];
    private $db = NULL;

    public function run(){
        $this->router = new Router();

        $class = "\\simpleengine\\" . $this->router->getPackage() . "\\" . $this->router->getController();
        $method = $this->router->getAction();

        if(class_exists($class)){
            $controller = new $class;
            $controller->setRequestedAction($this->router->getAction());

            if(method_exists($controller, $method)){
                $controller->$method();
            }
            else{
                throw new ApplicationException("Method " . $method . " not found in " . $class, 0503);
            }
        }
        else{
            throw new ApplicationException("Class " . $class . " not found", 0502);
        }
    }

    public function setConfiguration(array $configuration){
        if(empty($this->configuration))
            $this->configuration = $configuration;
        else
            throw new ApplicationException("Configuration has been already set up", 0501);
    }

    public function get(string $parameterName){
        $value = NULL;

        if(key_exists($parameterName, $this->configuration))
            $value = $this->configuration[$parameterName];
        else
            throw new ApplicationException("No config parameter found for key ".$parameterName);

        return $value;
    }

    public function router() : Router{
        return $this->router;
    }

    public function db(){
        if($this->db == NULL){
            $this->db = new Db();
        }

        return $this->db;
    }
}