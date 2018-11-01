<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));

$sql = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $id . "'")->fetch();
$main= $conn->query("SELECT * FROM `party` WHERE `leader` = '" . $user[id] . "'")->fetch();

if($main[leader] == $user[id] and $sql[party] == $main[id]) {
$query = $conn->prepare('UPDATE `users` SET `party` = NULL, `tag` = :tag WHERE `id` = :user');
$query->bindValue(":tag", '');
$query->bindValue(":user", $id);
$query->execute();
die('Игрок успешно кикнут');
} else {
echo 'Недостаточно прав<br>';
}
?>
