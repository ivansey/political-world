<?php
include('system/func.php');
auth();
banned($user);
moder_auth($user);

echo '
<div class="block">
Модераторские утилиты<br>
    <div class="a"><a href=money.php>Денежные средства[РАБОТАЕТ]</a><br></div>
    <div class="a"><a href=ban.php>Бан\Разбан игроков[РАБОТАЕТ]</a><br></div>
    <div class="a"><a href=chat.php>Чат[НЕ РАБОТАЕТ]</a><br></div></div>';
if($user['priv'] >= 2){
    echo '<div class="block">
    Администраторские утилиты<br>
	<div class="a"><a href=info.php>Редактирование информации об игроках[НЕ РАБОТАЕТ]</a><br></div></div>';
}
if($user['priv'] >= 3){
    echo '<div class="block">
    Супер-дминистраторские утилиты<br>
	<div class="a"><a href=priv.php>Изменение привелегий[В ПРОЦЕССЕ]</a><br></div>
	<div class="a"><a href=server_info.php>Информация о сервере[НЕ РАБОТАЕТ]</a></div></div>';
}
?>

