<?php
namespace simpleengine\core;
class Router
{
    private $urlData = [];
    private $package = "controllers";
    private $controller = "";
    private $action = "";
    private $parameter = "";

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
        // если адрес есть
        if(!empty($this->urlData["main"])){
            // получаем правила роутинга
            $rules = Application::instance()->get("ROUTER");

            // здесь будет храниться выбранное правило
            $activeRule = [];

            // перебираем правила, чтобы найти подходящее
            foreach($rules as $ruleSource => $ruleTarget) {
                // разбиваем правило на сегменты адреса
                $ruleData = explode("/", $ruleSource);

                // формируем регулярное выражение
                $pcre = '/\/';

                // анализируем сегменты правила
                foreach($ruleData as $rulePart){
                    if(mb_substr($rulePart, 0, 1, "UTF-8") != '<'){
                        // если это фиксированная часть
                        $pcre .= $rulePart.'\/';
                    }
                    else{
                        // если это placeholder
                        $pcre .= '([a-z0-9-]+\/)*';
                    }
                }

                $pcre .= '/';

                // проверяем, подходит ли вызванный адрес текущей регулярке
                if(preg_match($pcre, $this->urlData["main"])){
                    $activeRule['pattern'] = $ruleSource;
                    $activeRule['controller'] = $ruleTarget;
                    $activeRule['url'] = $this->urlData["main"];
                    break;
                }
            }

            // если правило сформировано, то вызываем нужный контроллер
            if(!empty($activeRule)){
                $this->setUpRouting($activeRule);
            }
            // иначе всегда кидаем на главную
            else{
                $this->setUpRouting(
                    [
                        "pattern" => "controllers/DefaultController/index",
                        "controller" => "controllers/DefaultController/index",
                        "url" => $this->urlData["main"]
                    ]
                );
            }
        }
    }

    /**
     * Метод назначения управляющих конструкций, исходя из URL
     * Назначаем пакет, контроллер, действие и параметры
     * @param $activeRule
     */
    private function setUpRouting(array $activeRule){
        // разбираем URL на соответствующие шаблону части
        $urlParts = [];
        foreach(array_filter(explode("/", $activeRule['url'])) as $item){
            if(!empty($item))
                $urlParts[] = $item;
        }

        // если правило содержит плейсхолдеры
        if(preg_match("/</", $activeRule["pattern"])) {
            // анализируем шаблон адреса
            foreach (explode("/", $activeRule["pattern"]) as $partKey => $patternPart) {
                $replacer = (isset($urlParts[$partKey]) ? $urlParts[$partKey] : "");

                // если часть - плейсхолдер
                if (preg_match("/</", $patternPart)) {
                    if (preg_match("/action/", $patternPart)) {
                        if($replacer != "")
                            $this->action = "action".ucfirst($replacer);
                        else
                            $this->action = "actionIndex";

                    }
                    if (preg_match("/controller/", $patternPart)) {
                        if($replacer != "")
                            $this->controller = ucfirst($replacer)."Controller";
                        else
                            $this->controller = "DefaultController";
                    }
                    if (preg_match("/parameter/", $patternPart)) {
                        $this->parameter = $replacer;
                    }

                    if (preg_match("/parameter/", $patternPart)) {
                        $this->parameter = $replacer;
                    }
                }
            }
        }

        $command = $activeRule['controller'];
        $commandParts = explode("/", $command);

        if(isset($commandParts[0]) && $commandParts[0] != "")
            $this->package = $commandParts[0];

        // если не задан controller
        if($this->controller == ""){
            if(isset($commandParts[1])){
                if($commandParts[1] != ""){
                    $this->controller = $commandParts[1];
                }
                else{
                    $this->controller = ucfirst($commandParts[1])."Controller";
                }
            }
            else{
                $this->controller = "DefaultController";
            }
        }

        // если не задан action
        if($this->action == ""){
            if(isset($commandParts[2]) && $commandParts[2] != ""){
                $this->action = "action".ucfirst($commandParts[2]);
            }
            else{
                $this->action = "actionIndex";
            }
        }

        if($this->parameter == "" && isset($commandParts[3]) && $commandParts[3] != ""){
            $this->parameter = $commandParts[3];
        }
        else if($this->package == ""){
            $this->parameter = "parameter";
        }
    }

    /**
     * @return string
     */
    public function getParameter()
    {
        return $this->parameter;
    }
}