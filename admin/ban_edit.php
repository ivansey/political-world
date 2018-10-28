<?php
include('../system/func.php');
auth();
moder_auth($user);
banned($user);

$id = $_POST['id'];
$time = $_POST['time'];
$about = $_POST['about'];
$query = $conn->prepare('UPDATE `users` SET `id` = :id, `ban_date` = :time, `ban_about` = :about');
$query->bindValue(":time", $time);
$query->bindValue(":about", $about);
$query->bindValue(":id", $id);
$query->execute();
header("Location: ban.php");
?>
    
