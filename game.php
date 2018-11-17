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
<div class="block">Регион нахождения<br>
<div class="a"><a href=regions/viev.php?id=' . $region_user['id'] . '>' . $region_user['name'] . '</a></br></div></div><br>
<div class="a"><a href=users/index.php>О персонаже</a></br></div><br>
<div class="a"><a href=regions>Регионы</a></br></div><br>
<div class="a"><a href=goverment>Государства</a></br></div><br>
<div class="a"><a href=party>Список партий</a></br></div><br>
';
if ($user['party'] != 0) {
    echo '<div class="a"><a href=party/party_view.php?id=' . $user['party'] . '>Моя партия</a></br></div><br>';
}
echo '
<div class="a"><a href=chat/index.php>Чат</a></br></div><br>
<div class="a"><a href=articles>Статьи</a></br></div><br>
<div class="a"><a href=work>Работа</a></br></div><br>
<div class="a"><a href=store/index.php>Склад</a><br></div><br>
<div class="a"><a href=market/index.php>Торговля</a><br></div><br>
';
if ($user['priv'] >= 1) {
    echo'
    <div class="a"><a href=admin/>Админ-панель</a></br></div>
    ';
}
echo'
</body>
';

