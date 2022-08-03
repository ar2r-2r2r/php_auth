<?php
    require "connection.php";
    unset($_SESSION['logged_user']);         //удаляем сессию
    header('Location: /');            //пересылаем пользователя на главную страницу
?>

