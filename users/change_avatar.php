<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 01.12.18
 * Time: 11:54
 */
include '../system/func.php';

$conn->query("update users set avatar = '" . $_POST['url'] . "' where id = " . $user['id']);
echo '<div class="block">Аватар вставлен</div><div class="a-down"><a href="index.php">Назад</a></div>';