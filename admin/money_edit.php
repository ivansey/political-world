<?php
include('../system/func.php');
auth();
banned($user);
moder_auth($user);
$id = $_POST['id'];
$money = $_POST['money'];
$gold = $_POST['gold'];
$query = $conn->prepare("UPDATE `users` SET `gold` = `gold` + :gold, `money` = `money` + :money WHERE `id` = :id");
$query->bindValue(":gold", $gold);
$query->bindValue(":money", $money);
$query->bindValue(":id", $id);
$query->execute();
log_admin($user, 'Выставлен бан игроку ' . name($id) . ' ' .  $money );
header("Location: money.php");
?>
