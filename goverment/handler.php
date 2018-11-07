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

$reg_id = $_POST['reg_id'];
$name = $_POST['name'];
$name = htmlentities($name);

$reg = $conn->prepare("SELECT COUNT(*) FROM `regions` WHERE `id` = " . $reg_id . ", `gover` = 0")->fetch()['COUNT(*)'];

if ($reg == 0) {
    echo '<div class="block">Регион занят<div class="a"><a href="../game.php">На главную</a></div></div>';
}

$query = $conn->prepare('INSERT INTO `goverment` SET `name` = :name, `king_id` = :user, `pri_reg` = :reg_id');
$query->bindValue(":name", $name);
$query->bindValue(":user", $user['id']);
$query->bindValue(":reg_id", $reg_id);
$query->execute();

echo '<div class="block">Государство создано<div class="a"><a href="../game.php">На главную</a></div></div>';
