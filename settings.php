<?php
include('system/func.php');
auth();
banned($user);

$type = _string(_num($_GET['type']));

if(!isset($type) or $type > 2) {
$type = 0;
}

if($user[api_token] == '0') {
$id = $user[id];
$token = bin2hex(openssl_random_pseudo_bytes(16));
$conn->query("UPDATE `users` SET `api_token` = '" . $token . "' WHERE `id` = '" . $id . "'");
}

switch($type) {
case 0:
echo '<a href="?type=1">Токен</a></br><a href="profile_viev.php">Назад в профиль</a>';
break;
case 1:
echo 'Ваш токен: '.$user[api_token].'</br><a href="settings.php">Назад</a>';
break;
}

?>
