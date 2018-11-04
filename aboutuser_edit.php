<?php
include('system/func.php');
auth();
banned($user);
$id = $user['id'];

$query = $conn->prepare('UPDATE `users` SET `about` = :about WHERE `id` = :id');
$query->bindValue(":about", htmlentities($_POST['about']));
$query->bindValue(":id", $id);
$query->execute();
echo("<div class='block'> Информация О себе изменена. <br> <div class='a'> <a href=profile_edit.php>Вернуться</a></div></div>");

