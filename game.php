<?php
include('system/func.php');
auth();
banned($user);
//if($user['ban'] == 1) {
//    header("Location: /errors/ban.php"); exit;
//}
?>
<html>
<head>
    <title>Главная</title>
</head>
<body>

<div class="a"><a href=profile_viev.php>О персонаже</a></br></div>
<div class="a"><a href=party>Список партий</a></br></div>
<?php
if ($user['party'] != 0) {
    echo '<div class="a"><a href=party/party_view.php?id=' . $user['party'] . '>Моя партия</a></br></div>';
}
?>
<div class="a"><a href=chat.php>Чат</a></br></div>
<div class="a"><a href=work>Работа</a></br></div>
<div class="a"><a href=store.php>Склад</a><br></div>
<div class="a"><a href=market.php>Торговля</a><br></div>
<div class="a"><a href=logout.php>Выход</a><br></div>
<?php
if ($user['priv'] >= 1) {
    ?>
    <div class="a"><a href=admin/>Админ-панель</a></br></div>
    <?php
}
?>
</body>

