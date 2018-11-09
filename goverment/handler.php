<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 03.11.18
 * Time: 18:57
 */
include "../system/func.php";
auth();
banned($user);
$q = 'Вы ебали медведя';
$reg_id = $_POST['reg_id'];
$name = $_POST['name'];
$name = htmlentities($name);

if ($name === '') {
    echo 'Name is empty';
}

$reg = $conn->query("SELECT COUNT(*) FROM `regions` WHERE `id` = " . $reg_id . " AND `gover` = 0")->fetch()['COUNT(*)'];
$king = $conn->query("SELECT COUNT(*) FROM `goverment` WHERE `king_id` = " . $user['id'] . " ")->fetch()['COUNT(*)'];

if ($king['king_id'] == $user['gover'] AND $king['id'] != 0) {
    echo '<div class="block">Вы и так глава государства<div class="a"><a href="../game.php">На главную</a></div></div>'; exit;
}
if ($reg == 0) {
    echo '<div class="block">Регион занят<div class="a"><a href="../game.php">На главную</a></div></div>'; exit;
}

$query = $conn->prepare('INSERT INTO `goverment` SET `name` = :name, `king_id` = :user, `pri_reg` = :reg_id');
$query->bindValue(":name", $name);
$query->bindValue(":user", $user['id']);
$query->bindValue(":reg_id", $reg_id);
$query->execute();

$gover = $conn->query("SELECT * FROM `goverment` WHERE `name` = '" . $name . "' ")->fetch();

$query = $conn->prepare('UPDATE `regions` SET `gover` = :gover WHERE `id` = :id');
$query->bindValue(":gover", $gover['id']);
$query->bindValue(":id", $reg_id);
$query->execute();

$query = $conn->prepare('UPDATE `users` SET `gover` = :gover WHERE `id` = :id');
$query->bindValue(":gover", $gover['id']);
$query->bindValue(":id", $user['id']);
$query->execute();

echo '<div class="block">Государство создано<div class="a"><a href="../game.php">На главную</a></div></div>';
