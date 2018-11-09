<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 08.11.18
 * Time: 18:59
 */
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
$party = $conn->query("SELECT * FROM `party` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();

if ($party['id'] == '') {
    die('<div class="block">Партия не найдена<div class="a"><a href="../game.php">На главную</a></div></div> '); exit;
}

if ($party['leader'] != $user['id']) {
    die('<div class="block">Партия не найдена<div class="a"><a href="../game.php">На главную</a></div></div> '); exit;
}

$conn->query("UPDATE `party` SET `reg` = " . $user['region'] . " WHERE `id` = " . $id . " ");

die('<div class="block">Регион изменён<div class="a"><a href="../game.php">На главную</a></div></div> '); exit;