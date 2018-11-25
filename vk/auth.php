<?php
include_once('func.php');
session_start();

$code = $_GET['code'];
$url = 'https://oauth.vk.com/access_token?client_id=6747984&client_secret=k1JoIQb4NYH648fBNwjz&redirect_uri=http://v92707.hosted-by-vdsina.ru/vk/auth.php&code=' . $code;

$result = file_get_contents($url);
$result = json_decode($result, true);

$access_token = $result['access_token'];
$user_id = $result['user_id'];

$login = get_login($user_id, $access_token);

try {
    create_user($user_id, $login);
} catch (PDOException $pdo_error) {
    echo $pdo_error->getMessage();
}

