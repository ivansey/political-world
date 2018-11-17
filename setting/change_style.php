<?php
include('../system/func.php');
auth();
banned($user);

// Created by code maestro

$option = $_POST['taskOption'];
if ($option) {
    $styless = $conn->query("SELECT * FROM `styles` WHERE `id` = " . $option . " ")->fetch();
    if ($styless['name'] != '') {
        $conn->query("UPDATE `users` SET `style` = '" . $option . "' WHERE `id` = " . $user['id'] . " ");
        die('<div class="block">Дизайн успешно изменен<br><div class="a"><a href=index.php>В настройки</a></div></div>');
    } else {
        die('Ошибка 1');
    }
} else {
    die('Ошибка два');
}

?>
