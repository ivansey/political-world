<?php
session_start();
include('system/func.php');
noauth();

if (!empty($_COOKIE['email'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
} else {
    $email = text($_POST['mail']);
    $password = text($_POST['password']);
}

$password_md5_1 = md5($password);

if (empty($email)) {
    die('<div class="block">Введите email</div>');
    ?><?php
} elseif (empty($password)) {
    die('<div class="block">Введите пароль</div>');
    ?><?php
} else {
    $sql = $conn->query("SELECT COUNT(*) FROM users WHERE mail='$email'")->fetch()['COUNT(*)'];
// тут запрос проверки, существует ли пользователь
    if ($sql == 0) {
        die('<div class="block">Пользователь не найден</div>');
        ?><?php
    } else {
        $sql2 = $conn->query("SELECT COUNT(*) FROM users WHERE password='$password_md5_1'")->fetch()['COUNT(*)'];
        if ($sql2 == 0) {
            die("<div class='block'>Пароль не верен</div>");
        } else {
            setcookie("email", $email);
            setcookie("password", $password_md5_1);
            header('Location: /');
        }
    }
}
?>
