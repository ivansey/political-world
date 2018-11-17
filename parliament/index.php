<?php
include('../system/func.php');
auth();
banned($user);

$id = _num(_string($_GET['id']));
$parlament_sql = $conn->query("SELECT COUNT(*) FROM `parlament` WHERE `gover` = " . $id)->fetch()['COUNT(*)'];
$parlament = $conn->query("SELECT * FROM `parlament` WHERE `gover` = " . $id)->fetch();
$gover = $conn->query("SELECT * FROM `goverment` WHERE `id` = " . $id)->fetch();

if ($parlament_sql == 0) {
    echo '<div class="block">Парламента не существует<div class="a"><a href="../game.php">На главную</a> </div> </div>'; exit;
}

echo 'Парламент государства ' . $gover['name'];
$i = 1;
while ($i < $parlament['sum']) {
    $users = $conn->query("SELECT * FROM `users` WHERE `id` = " . $parlament[$i])->fetch();
    if ($users['id'] == 0) {
        echo '<div class="block">Кресло пустое</div>';
    } else {
        echo name($users['id']);
    }
    $i++;
}
