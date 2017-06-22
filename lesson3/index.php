<!--
c composer нет особых проблем

Дамп данных - ошибка, запрос данных try { } не закрыт catch


-->


<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 22.06.2017
 * Time: 1:38
 */


// подгружаем и активируем авто-загрузчик Twig-а
require_once './vendor/autoload.php';

/*Twig_Autoloader::register();*/


try {
        $dbh = new PDO('mysql:dbname=lesson3;host=localhost', 'root', '');
    }

    catch (PDOException $e)

    {
        echo "Error: Could not connect. " . $e->getMessage();
    }

// установка error режима
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// выполняем запрос
try {
    // формируем SELECT запрос
    // в результате каждая строка таблицы будет объектом
    $sql = "SELECT small AS small, initial AS initial FROM gallery";
    $sth = $dbh->query($sql);
    while ($row = $sth->fetchObject()) {
        $data[] = $row;
    }
} catch (PDOException $e){}

    // закрываем соединение
    unset($dbh);


    try {
        // указывае где хранятся шаблоны
        $loader = new Twig_Loader_Filesystem('templates');

        // инициализируем Twig
        $twig = new Twig_Environment($loader);

        // подгружаем шаблон
        $template = $twig->loadTemplate('gallery.tmpl');
        $item = $twig->loadTemplate('item.tmpl');

        // передаём в шаблон переменные и значения
        // выводим сформированное содержание

        $images = $data;


        if ($_SERVER['REQUEST_URI'] == '/') {
            echo $template->render(array(
                'images' => $images,
                'uri' => $_SERVER['REQUEST_URI']
            ));
        } else echo $item->render(array(
                'images' => $images,
                'uri' => $_GET['image']
            )
        );

    } catch (Exception $e) {
        die ('ERROR: ' . $e->getMessage());
    }

