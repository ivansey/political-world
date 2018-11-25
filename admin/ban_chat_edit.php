<?php
include('../system/func.php');
auth();
moder_auth($user);
banned($user);

$id = $_POST['id'];
$time = $_POST['time'];
$about = $_POST['about'];
$query = $conn->prepare('UPDATE `users` SET `id` = :id, `ban_chat_date` = :time, `ban_chat_about` = :about');
$query->bindValue(":time", $time);
$query->bindValue(":about", $about);
$query->bindValue(":id", $id);
$query->execute();
log_admin($user, 'Выставлен бан игроку ' . name($id));
header("Location: ban_chat.php");
?>
    
