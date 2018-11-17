<?php
include('../system/func.php');
auth();
banned($user);
$leader = $conn->query("SELECT COUNT(*) FROM `party` WHERE `leader` = " . $user['id'] . " ")->fetch()['COUNT(*)'];
$party = $conn->query("SELECT * FROM `party` WHERE `id` = " . $user['party'] . " ")->fetch();

$id = _string(_num($_GET['id']));

$sql = $conn->query("SELECT COUNT(*) FROM `users` WHERE `party` = '" . $id . "'")->fetch()['COUNT(*)'];
if ($sql == 0 or $id == 0) {
    die('<div class="block">Партия не найдена</div>');
}

//Вывод сообщений
$i = 0;
$i2 = 1;
while ($i < $sql) {
    $echo = $conn->query("SELECT * FROM `users` WHERE `party` = '" . $id . "' LIMIT " . $i . "," . $i2 . " ")->fetch();
    if ($party['leader'] == $user['id']) {
        $msg = name($echo);
        if($party['leader'] == $user['id']) {
            $kick = ' <div class="a"> <a href=kick.php?id=' . $echo['id'] . '>Кикнуть</a></div><br>';
        } else {
            $kick = '';
}
        echo '<div class="block">' . $msg . $kick . '</div>';
    } else {
        $msg = name($echo) . "<br>";
        echo '<div class="block">' . $msg . '</div>';
    }
    $i++;
    $i2++;
}
echo '<div class="a"><a href=party_view.php?id=' . $id . '>Назад</a></div>';
?>
