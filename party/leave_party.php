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
    die('Вы не можете покинуть партию, будучи лидером <a href=party_view.php?id=' . $party['id'] . '>Назад</a>');
}
$conn->query("UPDATE `users` SET `party` = 0 WHERE `id` = " . $user['id'] . " ");
echo 'Вы вышли с партии';
echo '<a href="../game.php">На главную</a>';
?>