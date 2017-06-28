<?php
$configuration = [];

// Настройки окружения
$configuration["ENVIRONMENT"] = "PROD";

// настройки директорий
$configuration["DIR"]["VIEWS"] = $_SERVER["DOCUMENT_ROOT"]."/../simpleengine/views/";




// Настройки БД

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'lesson5';
const DB_CHARSET = 'utf8';
const DSN = 'mysql:dbname='.DB_NAME.';charset='.DB_CHARSET.';host='.DB_HOST.'';


$configuration["DB"]["DB_HOST"] = DB_HOST; // сервер БД
$configuration["DB"]["DB_USER"] = DB_USER; // логин
$configuration["DB"]["DB_PASS"] = DB_PASS; // пароль
$configuration["DB"]["DB_NAME"] = DB_NAME; // имя БД




// Настройки роутинга
$configuration["ROUTER"] = [
    "customController/<action>" => "controllers/CustomController/<action>",
    "hello/<action>" => "controllers/HelloController/<action>",
    "<controller>/<action>" => "<controller>/<action>"
];


