<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));

$sql = $conn->query("SELECT COUNT(*) FROM `users` WHERE `party` = '".$id."'")->fetch()['COUNT(*)'];

if($sql == 0 or $id == 0) {
die('Партия не найдена');
}

//Вывод сообщений
$i = 0;
while ($i < $sql) {
    $i++;
    $echo = $conn->query("SELECT * FROM `users` WHERE `party` = '" . $id . "' LIMIT " . $i . "," . $i . " ")->fetch();
$name = name($echo);
    $msg = " $name <br>";
    echo($msg);
}
