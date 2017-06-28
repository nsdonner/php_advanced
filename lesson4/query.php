<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 26.06.2017
 * Time: 7:37
 */

include 'conn.php';

// выполняем запрос


if (isset($_POST['more'])) {

    $mult = $_POST['more'];
    try {
        $sql = "SELECT good_name FROM `goods` LIMIT 0,". 250000*$mult;
        $sth = $dbh->prepare($sql);
        $sth->execute();

        while ($result = $sth->fetch()) {
            $data[] = $result[0];
        }

    } catch (PDOException $e) {
    }

    foreach ($data as $key => $line){

        echo '<li>'. $key.' '.$line .'</li>';
    }


} else {
    try {
        $sql = "SELECT good_name FROM `goods` LIMIT 0, 25";
        $sth = $dbh->prepare($sql);
        $sth->execute();

        while ($result = $sth->fetch()) {
            $data[] = $result[0];
        }

    } catch (PDOException $e) {
    }

    foreach ($data as $line){

        echo '<li>'. $line .'</li>';
    }
}


unset($dbh);