<?php
    require_once('User.php');
    require "connection.php";
    require "Db.php";
    $data=$_POST;

    if(isset($data['do_login']))                   //если была нажа кнопка войти
    {
        $errors=array();
//        $json = file_get_contents('db.json');
//        $jsonArray = json_decode($json, true);  //старые значения
        $db=new Db();
        $jsonArray=$db->read();
        if(count($jsonArray)>0 ){
            foreach ($jsonArray as $item) {
                if ($data['login'] === $item['login'] ) {          //проверка на совпадающий логин
                    if ($item['password'] === md5($data['password'] . 'solid') ) {          //проверка на совпадающий пароль
                        $_SESSION['logged_user']=$data['login'];
                        $islogin=true;
                        setcookie('logged_user',$data['login'], time() + 36000);
                    }
                }
            }
        }
        if ($islogin == true) {
            echo '<div style="color:green;">Вы авторизованы!<br/><a href="/">Переход на главную</a></div><hr>';
        } else {
            echo '<div style="color:red;">Неверный логин или пароль!<br/></div><hr>';
        }
    }

?>

<form action="login.php" method="POST">
    <p>
    <p><strong>Логин</strong></p>
    <input type="text" name="login" value="<?php echo@$data['login']; ?>">
    </p>

    <p>
    <p><strong>Пароль</strong></p>
    <input type="password" name="password" value="<?php echo@$data['password']; ?>">
    </p>
    </p>

    <p>
        <button type="submit" name="do_login">Войти</button>
    </p>
</form>
