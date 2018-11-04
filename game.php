<?php
include('system/func.php');
auth();
banned($user);
//if($user['ban'] == 1) {
//    header("Location: /errors/ban.php"); exit;
//}
echo '
<html>
<head>
    <title>Главная</title>
</head>
<body>
<div class="block">Регион<br>
<div class="a"><a href=regions/viev.php?id=' . $region_user['id'] . '>' . $region_user['name'] . '</a></br></div></div>
<div class="a"><a href=profile_viev.php>О персонаже</a></br></div>
<div class="a"><a href=party>Список партий</a></br></div>
';
if ($user['party'] != 0) {
    echo '<div class="a"><a href=party/party_view.php?id=' . $user['party'] . '>Моя партия</a></br></div>';
}
echo '
<div class="a"><a href=chat.php>Чат</a></br></div>
<div class="a"><a href=articles>Статьи</a></br></div>
<div class="a"><a href=work>Работа</a></br></div>
<div class="a"><a href=store.php>Склад</a><br></div>
<div class="a"><a href=select_market.php>Торговля</a><br></div>
<div class="a"><a href=logout.php>Выход</a><br></div>
';
if ($user['priv'] >= 1) {
    echo'
    <div class="a"><a href=admin/>Админ-панель</a></br></div>
    ';
}
echo'
</body>
';

