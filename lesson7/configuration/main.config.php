<?php
$configuration = [];

// Настройки окружения
$configuration["ENVIRONMENT"] = "PROD";

// настройки директорий
$configuration["DIR"]["VIEWS"] = $_SERVER["DOCUMENT_ROOT"]."/../simpleengine/views/";

// Настройки БД
$configuration["DB"]["DB_HOST"] = "172.29.0.250"; // сервер БД
$configuration["DB"]["DB_USER"] = "root"; // логин
$configuration["DB"]["DB_PASS"] = ""; // пароль
$configuration["DB"]["DB_NAME"] = "lesson7"; // имя БД
$configuration["DB"]["DB_CHARSET"] = "UTF8"; // кодировка БД

// Настройки роутинга
$configuration["ROUTER"] = [
    "customController/<action>" => "controllers/CustomController/<action>",
    "hello/<action>" => "controllers/HelloController/<action>",
    "<controller>/<action>" => "controllers/<controller>/<action>"
];


