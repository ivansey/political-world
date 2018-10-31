<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 31.10.18
 * Time: 8:16
 */
include('../system/func.php');
auth();
banned($user);

$id = $_GET['id'];
echo $id;
$party = $conn->query("SELECT * FROM `party` WHERE `id` = " . $id . " ")->fetch();
$tag = $party['tag'];
echo $tag;
$query = $conn->prepare('UPDATE `users` SET `party` = :id, `tag` = :tag WHERE `id` = :user');
$query->bindValue(":id", $id);
$query->bindValue(":tag", $tag);
$query->bindValue(":user", $user['id']);
$query->execute();
echo 'Вы вступили';
echo '<a href="../game.php">На главную</a>';