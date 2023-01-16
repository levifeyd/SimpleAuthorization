<?php 
    // $login = $_POST['login'];
    // echo $login;
    $login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);


    if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
        echo 'Недопустимая длинная логина';
        exit();
    } else if(mb_strlen($name) < 3 || mb_strlen($name) > 50) {
        echo 'Недопустимая длинная имени';
        exit();
    } else if(mb_strlen($pass) < 2 || mb_strlen($pass) > 6) {
        echo 'Недопустимая длина пароля (от 2 до 6 символов)';
        exit();
    }

    $pass = md5($pass."qwerty"); // кэшируем пароль

    $mysql = new mysqli('localhost', 'root', '', 'eShop');
    $mysql->query("INSERT INTO `users` (`login`, `pass`, `name`)
    VALUES('$login', '$pass', '$name')");

    $mysql->close();

    header('Location: /'); // выводим первую страницу
    exit();
?>