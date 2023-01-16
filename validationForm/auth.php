<?php
    $login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);

    $pass = md5($pass."qwerty"); // кэшируем пароль

    $mysql = new mysqli('localhost', 'root', '', 'eShop');

    $result= $mysql->query("SELECT * FROM `users` WHERE `login`=
    '$login' AND `pass` = '$pass'");

    $user = $result->fetch_assoc(); // convetr to array

    if (count($user) == 0) {
        // echo ;
        exit(@"Такой пользователь не найден");
    }

    // authorixation 
    setcookie('user', $user['name'], time() + 3600, "/"); // куки живет 3600 секунд


    $mysql->close();

    header('Location: /'); // выводим первую страницу
    exit();

?>