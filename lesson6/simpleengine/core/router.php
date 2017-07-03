<?php
namespace simpleengine\core;
class Router
{
    private $urlData = [];
    private $package = "";
    private $controller = "";
    private $action = "";
    public function __construct()
    {
        $urlParts = explode("?", $_SERVER["REQUEST_URI"]);
        $this->urlData["main"] = $urlParts[0];
        if(isset($urlParts[1])){
            $this->urlData["get"] = explode("&", $urlParts[1]);
        }
        $this->applyUrlMapping();
    }
    public function getController() : string {
        return $this->controller;
    }
    public function getAction() : string {
        return $this->action;
    }
    public function getPackage() : string {
        return $this->package;
    }
    /**
     * Метод разборки URL
     */
    private function applyUrlMapping(){
        if(!empty($this->urlData["main"])){
            $rules = Application::instance()->get("ROUTER");
            $activeRule = [];
            foreach($rules as $ruleSource => $ruleTarget){
                // превращаем правило в регулярное выражение
                $ruleData = explode("/", $ruleSource);
                $pcre = "/\/";
                foreach($ruleData as $rulePart){
                    if(mb_substr($rulePart, 0, 1, "UTF-8") != '<'){
                        // если это фиксированная часть
                        $pcre .= $rulePart."\/";
                    }
                    else{
                        // это шаблон
                        $pcre .= "([a-z0-9-]+\/)*";
                    }
                }
                $pcre .= "/";
                if(preg_match($pcre, $this->urlData["main"])){
                    $activeRule['pattern'] = $ruleSource;
                    $activeRule['controller'] = $ruleTarget;
                    break;
                }
            }
            if(!empty($activeRule)){
                $this->setUpRouting($activeRule);
            }
        }
    }
    /**
     * Метод назначения управляющих конструкций, исходя из URL
     * @param $activeRule
     */
    private function setUpRouting($activeRule){
        $command = $activeRule["controller"];
        $urlPartsTmp = array_filter(explode("/", $this->urlData["main"]));
        $urlParts = [];
        foreach($urlPartsTmp as $item){
            if(!empty($item))
                $urlParts[] = $item;
        }
        // если правило - это шаблон
        if(preg_match("/</", $activeRule["pattern"])) {
            foreach (explode("/", $activeRule["pattern"]) as $partKey => $patternPart) {
                if (preg_match("/</", $patternPart)) {
                    $replacer = (isset($urlParts[$partKey]) ? $urlParts[$partKey] : "");
                    $command = str_replace($patternPart, $replacer, $command);
                    if (preg_match("/action/", $patternPart)) {
                        $this->action = $replacer;
                    }
                    if (preg_match("/controller/", $patternPart)) {
                        $this->controller = $replacer;
                    }
                    if (preg_match("/package/", $patternPart)) {
                        $this->package = $replacer;
                    }
                }
            }
        }
        $commandParts = explode("/", $command);
        if($this->action == "" && isset($commandParts[2]) && $commandParts[2] != ""){
            $this->action = $commandParts[2];
        }
        else if($this->action == ""){
            $this->action = "index";
        }
        if($this->controller == "" && isset($commandParts[1]) && $commandParts[1] != ""){
            $this->controller = $commandParts[1];
        }
        else if($this->controller == ""){
            $this->controller = "DefaultController";
        }
        if($this->package == "" && isset($commandParts[0]) && $commandParts[0] != ""){
            $this->package = $commandParts[0];
        }
        else if($this->package == ""){
            $this->package = "controllers";
        }
    }
}