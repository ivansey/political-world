<?php
include('../system/func.php');

$act = _string(_num($_GET['act']));
$token = _string($_GET['token']);
$extra = _string($_GET['extra']);# extra parameter

/* act — что делать, token — токен юзверя, extra - доп.параметр*/

/*
Список методов:
0 - информация о владельце токена
1 - информация о другом человеке(в extra id)
2 - просмотр чата
3 - написать сообщение в чат(в extra текст)
*/


if($token) {
$client = $conn->query("SELECT * FROM `users` WHERE `api_token` = '" . $token . "' LIMIT 1")->fetch();
if($client[id] == '') {
die('Error: unknown token');
} else {
switch($act){
case 0:
die("$client[id];$client[name];$client[mail];$client[about];$client[money];$client[gold];$client[priv];$client[date_reg]");
break;
case 1:
if($extra) {
$person = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $extra . "' LIMIT 1")->fetch();
die("$person[id];$person[name];$person[about]");
} else
{
	die("Error: required optional extra");
}
break;
default:
die('Error: unknown act');
break;
}
}
}

?>
