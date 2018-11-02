<?php
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
$party = $conn->query("SELECT * FROM `party` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();

if ($party[id] == '') {
    die('<div class="block">Партия не найдена<div class="a"><a href="../game.php">На главную</a></div></div> ');
}

$leader = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $party[leader] . "' LIMIT 1")->fetch();
$lname = name($leader);
echo '<div class="block"> <center>Партия ' . $party[name] . '<hr>Информация<hr></center>Глава партии: ' . $lname . '</br>Описание партии:' . $party[about] . '<div class="a"><a href=party_members.php?id=' . $id . '>Участники партии</a></div>';
if ($user[party] == $party[id]) {
    echo '<div class="a"> <a href=leave_party.php>Выйти из партии</a></div>';
}
if ($user[party] == 0) {
    echo '<div class="a"> <a href=join_party.php?id=' . $party['id'] . '>Вступить в партию</a></div>';
}
if ($leader[id] == $user[id]) {
    echo '<div class="a">
                <form action="" method="post">
                    <input type="submit" name="prt" value="Управление">
                </form>
      </div></div>
    ';

}
echo '<br>';
?>
<div class="a"><a href="index.php">В список партий</a></div>
<div class="a"><a href="../game.php">На главную</a></div>