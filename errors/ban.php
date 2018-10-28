//Страница бана
Вы забанены
<?php
include('../system/func.php');
auth();
$id = $user['id'];
$ban_about = $user['ban_about'];
$ban_time = $user['ban_time'];
echo 'По причине: ' . $ban_about . '<br>До: ' . $ban_time;
?>
<a href="../game.php">Обновить</a>
