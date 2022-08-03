<?php
require_once 'User.php';
require "connection.php";
require "Db.php";

$isAjax = false ;
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // сюда попадаем в случае AJAX-запроса
    $isAjax = true ;
    $login = $_POST['login'];
    $password = $_POST['password'];

    if($login =="" || $password==""){
        echo json_encode('Введите логин и пароль!');
        exit();
    }
    $db = new Db();
    $jsonArray = $db->read();
    $errors = array();
    if (count($jsonArray) > 0) {
        foreach ($jsonArray as $item) {
            if ($login === $item['login']) {          //проверка на совпадающий логин
                if ($item['password'] === md5($password . 'solid')) {          //проверка на совпадающий пароль
                    session_start();
                    $_SESSION['logged_user'] = $login;
                    $islogin = true;
                    setcookie('logged_user', $login, time() + 36000);
                }
            }
        }
    }
    if ($islogin == true) {
        echo json_encode('<div style="color:green;">Вы авторизованы!<br/><a href="/">Переход на главную</a></div><hr>');
    } else {
        echo json_encode('Неверный логин или парль');
    }
}else{
    echo json_encode('Не ajax запрос!');
}






