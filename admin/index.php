<?php
include('../system/func.php');
auth();
banned($user);
moder_auth($user);

echo '
<div class="block"> Модераторские утилиты<br>
    <!--<a href=money.php>Денежные средства[РАБОТАЕТ]</a><br>-->
    <div class="a"><a href=ban.php>Бан\Разбан игроков</a></div><br>
    <div class="a"><a href=index.php>Чат[НЕ РАБОТАЕТ]</a></div></div><br>';
if ($user['priv'] >= 2) {
    echo '
    <div class="block">Администраторские утилиты<br>
	<div class="a"><a href=info.php>Редактирование информации об игроках[НЕ РАБОТАЕТ]</a></div></div><br>';
}
if ($user['priv'] >= 3) {
    echo '
    <div class="block">Супер-дминистраторские утилиты<br>
	<div class="a"><a href=server_info.php>Информация о сервере[НЕ РАБОТАЕТ]</a></div><br>
	<div class="a"><a href="log_admin.php">Логи админов</a></div></div><br>';
}
echo '<div class="a"><a href="../game.php">На главную</a></div>';

