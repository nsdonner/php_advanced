<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 26.06.2017
 * Time: 6:55
 */



try {
    $dbh = new PDO('mysql:dbname=lesson5;charset=UTF8;host=localhost', 'root', '');
}

catch (PDOException $e)

{
    echo "Error: Could not connect. " . $e->getMessage();
}

// установка error режима
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


