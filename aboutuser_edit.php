<?php
include('system/func.php');
auth();
banned($user);
$email = $_COOKIE['email'];
$about = $_POST['about'];
$conn->query("UPDATE `users` SET `about` = '" . $about . "' WHERE `mail` = '" . $email . "'");
echo("<div class='block'> Информация О себе изменена. <br> <div class='a'> <a href=profile_edit.php>Вернуться</a></div></div>");

