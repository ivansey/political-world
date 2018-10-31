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
<a href=profile_viev.php>О персонаже</a></br>
<a href=party>Список партий</a></br>
<?php
if ($user['party'] != 0) {
    echo '<a href=party/party_view.php?id=' . $user['party'] . '>Моя партия</a></br>';
}
?>
<a href=chat.php>Чат</a></br>
<a href=work>Работа</a></br>
<a href=store.php>Склад</a><br>
<a href=market.php>Торговля</a><br>
<a href=logout.php>Выход</a><br>
<?php
if ($user['priv'] >= 1) {
    ?>
    <a href=admin/>Админ-панель</a></br>
    <?php
}
?>
</body>

