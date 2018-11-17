<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 03.11.18
 * Time: 18:57
 */
include "../system/func.php";
auth();
su_auth($user);
banned($user);

$name = $_POST['name'];
$name = htmlentities($name);

$query = $conn->prepare('INSERT INTO `regions` SET `name` = :name, `gover` = 0');
$query->bindValue(":name", $name);
$query->execute();
//$reg = $conn->query("SELECT * FROM regions WHERE name = " . $name)->fetch();
log_admin($user, "Создан регион:" . $name);
echo '<div class="block">Регион создан<div class="a"><a href="../game.php">На главную</a></div></div>';
