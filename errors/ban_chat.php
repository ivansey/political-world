//Страница бана чата
Вы забанены
<?php
include('../system/func.php');
auth();
$id = $user['id'];
$ban_chat_about = $user['ban_chat_about'];
$ban_chat_time = $user['ban_chat_time'];
echo '<div class="block">По причине: ' . $ban_chat_about . '<br>До: ' . $ban_chat_time;
?>
<div class="a"><a href="../game.php">Обновить</a></div></div>
