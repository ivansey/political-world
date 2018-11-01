<?php
include('system/func.php');
auth();
banned($user);

// Created by code maestro

$option = $_POST['taskOption'];
if ($option)  {
$styless = $conn->query("SELECT * FROM `styles` WHERE `id` = ".$option." ")->fetch();
if($styless[name] != '') {
$conn->query("UPDATE `users` SET `style` = '" . $option . "' WHERE `id` = ".$user[id]." ");
die('Дизайн успешно изменен<br><a href=settings.php>В настройки</a>');
} else {
die('Ошибка 1');
}
} else {
die('Ошибка два');
}

?>
