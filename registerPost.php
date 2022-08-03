<?php
    require_once 'User.php';
    require "connection.php";
    require "Db.php";


    $data = $_POST;
    $errors = array();              //создаём массив куда будут заноситься ошибки

    if (!preg_match('/^[A-Za-z0-9]{6,}$/', trim($data['login']))) {
        $errors[] = 'Логин должен состоять более чем из 6 символов';

    }

    if (!preg_match('/^[A-Za-z]{2}$/', trim($data['name']))) {
        $errors[] = 'Имя должно быть только из букв, а также длиной 2 символа';

    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Неверная форма электронной почты';

    }

    if (empty($data['email'])) {
        $errors[] = 'Введите емаил';

    }

    if (!preg_match('/^\S*(?=\S{6,})(?=\S*[A-Za-z])(?=\S*[\d])\S*$/', trim($data['password']))) {
        $errors[] = 'Пароль должен содержать минимум 6 символов, включающий цифры и буквы';

    }

    if ($data['password2'] != $data['password']) {
        $errors[] = 'Повторный пароль введён неверно!';

    }

    if ($data['password2'] != $data['password']) {
        $errors[] = 'Повторный пароль введён неверно!';

    }

    $db = new Db();
    $jsonArray = $db->read();                               //читаем существующие записи
    if ((count($jsonArray)) > 0) {                           //если записи сущесвутют
        foreach ($jsonArray as $item) {                         //для каждой записи
            if ($data['login'] === $item['login']) {          //проверка на повторный логин
                $errors[] = 'Такой логин уже существует!';

            }
            if ($data['email'] === $item['email']) {          //проверка на повторный емаил
                $errors[] = 'Такой email уже существует!';

            }
        }
    }

    if (empty($errors)) {             //ошибок нет, значит регестрируем
        $encryptedPassword = md5($data['password'] . 'solid');          //шифруем пароль
        $user = new User($data['login'], $data['name'], $data['email'], $encryptedPassword);
        $db->update($user);                                         //заносим в б.д.
        echo json_encode('<div style="color:green;">Вы успешно зарегестрированы!<a href="/"><button>Переход на главную</button></a>');
    }else{
        $a=array_shift($errors);                //получаем первый элемент из списка ошибок(первую ошибку)
        echo json_encode($a);                           //отправляем её
    }



