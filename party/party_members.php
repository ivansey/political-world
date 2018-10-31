<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));

$sql = $conn->query("SELECT COUNT(*) FROM `users` WHERE `party` = '" . $id . "'")->fetch()['COUNT(*)'];
if ($sql == 0 or $id == 0) {
    die('Партия не найдена');
}

//Вывод сообщений
$i = 0;
$i2 = 1;
while ($i < $sql) {
    $echo = $conn->query("SELECT * FROM `users` WHERE `party` = '" . $id . "' LIMIT " . $i . "," . $i2 . " ")->fetch();
    $msg = name($echo) . "<br>";
    echo($msg);
    $i++;
    $i2++;
}
echo '<a href=party_view.php?id=' . $id . '>Назад</a>';
?>
