<?php
include('../system/func.php');
auth();
banned($user);
su_auth($user);

$id = $_POST['id'];
$priv = $_POST['priv'];

$query = $conn->prepare('UPDATE `users` SET `priv` = :priv WHERE `id` = :id');
$query->bindValue(":priv", $priv);
$query->bindValue(":id", $id);
$query->execute();
echo("Пользователь получил права");
?>
