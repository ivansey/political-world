<?php
//include('../system/func.php');
//auth();
//banned($user);
//moder_auth($user);

echo '
Модераторские утилиты<br>
    <a href=money.php>Денежные средства[РАБОТАЕТ]</a><br>
    <a href=ban.php>Бан\Разбан игроков[РАБОТАЕТ]</a><br>
    <a href=chat.php>Чат[НЕ РАБОТАЕТ]</a><br>';
if($user['priv'] >= 2){
    echo '
    Администраторские утилиты<br>
	<a href=info.php>Редактирование информации об игроках[НЕ РАБОТАЕТ]</a><br>';
}
if($user['priv'] >= 3){
    echo '
    Супер-дминистраторские утилиты<br>
	<a href=priv.php>Изменение привелегий[В ПРОЦЕССЕ]</a><br>
	<a href=server_info.php>Информация о сервере[НЕ РАБОТАЕТ]</a>';
}
?>

