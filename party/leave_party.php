<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 31.10.18
 * Time: 7:57
 */
include('../system/func.php');
auth();
banned($user);
$id = $user['party'];
$party = $conn->query("SELECT * FROM `party` WHERE `id` = " . $id . " ")->fetch();
if ($party['leader'] == $user['id']) {
    die('<div class="block">Вы не можете покинуть партию, будучи лидером <div class="a"><a href=party_view.php?id=' . $party['id'] . '>Назад</a></div></div>');
}
$conn->query("UPDATE `users` SET `party` = 0,  `tag` = '' WHERE `id` = " . $user['id'] . " ");
echo '<div class="block">Вы вышли с партии';
echo '<div class="a"><a href="../game.php">На главную</a></div></div>';
?>
