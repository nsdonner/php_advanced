<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 26.06.2017
 * Time: 7:40
 */




?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script
        src="http://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>


    <ul id="goods">
        <?php
        include 'query.php';


        ?>

    </ul>
    <input id="more" value="MORE!" type="button" />

    <script>

    $(document).ready(function() {
    // Здесь мы пропишим необходимый код

       var i=1;
       $("#more").click(function () {

           i++;
           $.post("query.php", {more:i}, function (data) {
               $("#goods").html(data);
           });

           return false;

       });


    });


    </script>




</body>
</html>












