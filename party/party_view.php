<?php
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
$party = $conn->query("SELECT * FROM `party` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();

if($party[id] == '') {
die('Партия не найдена');
}

$leader = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $party[leader] . "' LIMIT 1")->fetch();
$lname = name($leader);
echo '<center>Партия '.$party[name].'<hr>Информация<hr></center>Глава партии: '.$lname.'</br>Описание партии:'.$party[about].'<br><a href=party_members.php?id='.$id.'>Участники партии</a>';
if($user[party] == $party[id]) {
echo '<a href=leave_party.php>Выйти из партии</a>';
}
if($leader[id] == $user[id]) {
echo '<hr><center>Управление</center><hr>Скоро...';

}
?>
