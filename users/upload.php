<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 01.12.18
 * Time: 10:36
 */
include '../system/func.php';
if ($_FILES['filename']['size'] > 1024 * 3 * 1024) {
    echo '<div class="block">Файл слишком большой</div>';
    exit;
}

if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
    move_uploaded_file($_FILES['filename']['tmp_name'], "../resource/users/avatars/" . $user['id'] . ".jpeg");
} else {
    echo '<div class="block">Ошибка</div>';
}

$conn->query("update users set avatar = '/resource/users/avatars/" . $user['id'] . ".jpeg' where id = " . $user['id']);
echo '<div class="a-down"><a href="edit.php">Назад</a></div>';