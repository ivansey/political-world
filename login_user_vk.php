<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 11.11.18
 * Time: 9:53
 */
session_start();
include('system/func.php');
noauth();

$email = $_COOKIE['email'];
$password = $_COOKIE['password'];

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
        $sql2 = $conn->query("SELECT COUNT(*) FROM users WHERE password='$password'")->fetch()['COUNT(*)'];
        if ($sql2 == 0) {
            die("<div class='block'>Пароль не верен</div>");
        } else {
            setcookie("email", $email);
            setcookie("password", $password);
            header('Location: /');
        }
    }
}
?>
