<?php
require_once('db_connect.php');

//Подключение классов
//include 'class/kernel.php';
include 'class/bbcode.php';
include 'class/smile.php';
include 'class/goverment.php';
include 'class/laws.php';

//Вывод логов
function php_error_log()
{
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
}

function text($m)
{
    $m = htmlspecialchars(stripslashes(trim($m)));
    return $m;
}

function name($userr)
{
    if ($userr['tag'] == "") {
        $ur = "<a href='../users/index.php?user_id=" . $userr['id'] . "'>" . $userr['name'] . "</a>";
    } else {
        $ur = "<a href='../users/index.php?user_id=" . $userr['id'] . "'>" . "[" . $userr['tag'] . "] " . $userr['name'] . "</a>";
    }
    return $ur;
}

function idtoname($id)
{
    global $conn;
    $user_sql = $conn->query("select * from users where id = " . $id)->fetch();
    if ($user_sql['tag'] == "") {
        $ur = "<a href='../users/index.php?user_id=" . $user_sql['id'] . "'>" . $user_sql['name'] . "</a>";
    } else {
        $ur = "<a href='../users/index.php?user_id=" . $user_sql['id'] . "'>" . "[" . $user_sql['tag'] . "] " . $user_sql['name'] . "</a>";
    }
    return $ur;
}

function notification($text, $time, $href, array $userrr)
{
    global $conn;
    $conn->query("INSERT INTO notifications SET text = '$text', time = '$time', href = '$href', user = $userrr[id]");
}

function auth()
{
    if (empty($_COOKIE["email"])) {
        header("Location: index.php");
        exit;
    }
}

function noauth()
{
    if (!empty($_COOKIE["email"])) {
        header("Location: game.php");
        exit;
    }
}

if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    $user = $conn->query("SELECT * FROM `users` WHERE `mail` = '" . $email . "' AND `password` = '" . $password . "' LIMIT 1")->fetch();
    $region_user = $conn->query("SELECT * FROM `regions` WHERE `id` = " . $user['region'] . " ")->fetch();
    if ($user[energy] > 200) {
        $conn->query("UPDATE `users` SET `energy` = 200 WHERE `id` = " . $user['id'] . " ");
    }
    require_once('header_auth.php');
} else {
    require_once('header.php');
}

//Инфа о складе 
//$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . "")->fetch();
//ИД юзера
//$id_user = $user['id'];
//Админ/Модер проверка
function moder_auth(array $user)
{
    if ($user['priv'] < 1) {
        header("Location: /");
        exit;
    }
}

function admin_auth(array $user)
{
    if ($user['priv'] < 2) {
        header("Location: /");
        exit;
    }
}

function su_auth(array $user)
{
    if ($user['priv'] < 3) {
        header("Location: /");
        exit;
    }
}

function _string($string)
{
    return (String)$string;
}

function _num($i)
{
    return (int)$i;
}

//Проверка бана
function banned(array $user)
{
    $time = date('Y-m-d H:i:s.u');
    if ($user['ban_date'] > $time) {
        header("Location: /errors/ban.php");
        exit;
    }
}

function banned_chat(array $user)
{
    $time = date('Y-m-d H:i:s.u');
    if ($user['ban_chat_date'] > $time) {
        header("Location: /errors/ban_chat.php");
        exit;
    }
}

function closed(array $user)
{
    if ($user['priv'] != 3) {
        die('<div class="block">Проводятся тех.работы' . $user[priv] . '</div><br><div class="a"><a href=/>На главную</a></div>');
    }
}

?>
