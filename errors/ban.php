//Страница бана
Вы забанены
<?php
include('../system/func.php');
auth();
$id = $user['id'];
$ban_about = $user['ban_about'];
$ban_time = $user['ban_time'];
echo '<div class="block">По причине: ' . $ban_about . '<br>До: ' . $ban_time;
?>
<div class="a"><a href="../game.php">Обновить</a></div></div>
