//Страница бана чата
Вы забанены
<?php
include('../system/func.php');
auth();
$id = $user['id'];
$ban_chat_about = $user['ban_chat_about'];
$ban_chat_time = $user['ban_chat_time'];
echo 'По причине: ' . $ban_chat_about . '<br>До: ' . $ban_chat_time;
?>
<a href="../game.php">Вернуться</a>
