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

<div class="a"><a href=users/index.php>О персонаже</a></br></div>
<div class="a"><a href=party>Список партий</a></br></div>
<?php
if ($user['party'] != 0) {
    echo '<div class="a"><a href=party/party_view.php?id=' . $user['party'] . '>Моя партия</a></br></div>';
}
?>
<div class="a"><a href=chat/index.php>Чат</a></br></div>
<div class="a"><a href=articles>Статьи</a></br></div>
<div class="a"><a href=work>Работа</a></br></div>
<div class="a"><a href=store/index.php>Склад</a><br></div>
<div class="a"><a href=market/index.php>Торговля</a><br></div>
<div class="a"><a href=logout.php>Выход</a><br></div>
<?php
if ($user['priv'] >= 1) {
    ?>
    <div class="a"><a href=admin/>Админ-панель</a></br></div>
    <?php
}
?>
</body>

