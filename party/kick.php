<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));

$sql = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $id . "'")->fetch();
$main= $conn->query("SELECT * FROM `party` WHERE `leader` = '" . $user[id] . "'")->fetch();

if($main[leader] == $user[id] and $sql[party] == $main[id] and $main[leader] != $id) {
$query = $conn->prepare('UPDATE `users` SET `party` = NULL, `tag` = :tag WHERE `id` = :user');
$query->bindValue(":tag", '');
$query->bindValue(":user", $id);
$query->execute();
// Notify start
$timee = date("H:i:s");
notification("Вы были изгнаны из партии", $timee, "", $sql);
// Notify end
die('<div class="block">Игрок успешно кикнут</div>');
} else {
echo '<div class="block">Ошибка</div>';
}
echo '<div class="a"> <a href="../game.php">На главную</a></div></div>';
?>
