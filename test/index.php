<?php
    require "connection.php";
?>


<?php
    if(isset($_SESSION['logged_user']) && $_COOKIE['logged_user']===$_SESSION['logged_user']):?>
    Hello <?php  echo ($_COOKIE['logged_user']) ?> <hr>
    Вы уже авторизованы!<br>
    <a href="/logout.php">Выйти</a>


<?php else:?>
    <a href="/login.php">Авторизоваться</a><br>
    <a href="/signup.php">Регистрация</a>
<?php endif;?>
