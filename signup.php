
<?php
require_once('User.php');
require "connection.php";
require "Db.php";
    $data=$_POST;
    if(isset($data['do_signup']))                   //если была нажа кнопка регистрации
    {
        $errors=array();
        if (!preg_match('/^[A-Za-z0-9]{6,}$/', trim($data['login']))){
            $errors[] = 'Логин должен состоять более чем из 6 символов';
        }
        if (!preg_match('/^[A-Za-z]{2}$/', trim($data['name']))){
            $errors[] = 'Имя должно быть только из букв, а также длиной 2 символа';
        }

        if (empty($data['email'])){
            $errors[] = 'Введите емаил';
        }
        if (!preg_match('/^\S*(?=\S{6,})(?=\S*[A-Za-z])(?=\S*[\d])\S*$/', trim($data['password']))) {
            $errors[] = 'Пароль должен содержать минимум 6 символов, включающий цифры и буквы';
        }
        if($data['password2']!=$data['password'])
        {
            $errors[]='Повторный пароль введён неверно!';
        }

        if($data['password2']!=$data['password'])
        {
            $errors[]='Повторный пароль введён неверно!';
        }
        $db=new Db();
        $jsonArray=$db->read();
        if((count($jsonArray))>0 ){
            foreach ($jsonArray as $item) {
                if ($data['login'] === $item['login'] ) {          //проверка на повторный логин
                    $errors[]='Такой логин уже существует!';
                }
                if ($data['email'] === $item['email'] ) {          //проверка на повторный емаил
                    $errors[]='Такой email уже существует!';
                }
            }
        }

        if(empty($errors)){             //ошибок нет, значит регестрируем
            $encryptedPassword = md5($data['password'] . 'solid');
            $user = new User($data['login'], $data['name'], $data['email'], $encryptedPassword);
//            $json = file_get_contents('db.json');
//            $jsonArray = json_decode($json, true);  //старые значения
            $db->update($user);
            //file_put_contents('db.json', json_encode($jsonArray));  //ложим и старые и новые
            echo '<div style="color:green;">Вы успешно зарегестрированы!<a href="/"><button>Переход на главную</button></a>';
        }else{
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }
    }


?>

<form action="/signup.php" method="POST">

    <p>
        <p><strong>Ваш логин</strong></p>
        <input type="text" name="login" value="<?php echo@$data['login']; ?>">
    </p>

    <p>
    <p><strong>Ваше имя</strong></p>
    <input type="text" name="name" value="<?php echo@$data['name']; ?>">
    </p>

    <p>
    <p><strong>Ваш email</strong></p>
    <input type="email" name="email" value="<?php echo@$data['email']; ?>">
    </p>

    <p>
    <p><strong>Ваш пароль</strong></p>
    <input type="password" name="password" value="<?php echo@$data['password']; ?>">
    </p>

    <p>
    <p><strong>Ваш пароль ещё раз</strong></p>
    <input type="password" name="password2" value="<?php echo@$data['password2']; ?>">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрирооваться</button>
    </p>
</form>