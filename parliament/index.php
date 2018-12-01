<?php
include('../system/func.php');
auth();
banned($user);

$id = _num(_string($_GET['id']));
$parliament_sql = $conn->query("SELECT COUNT(*) FROM `parlament` WHERE `gover` = " . $id)->fetch()['COUNT(*)'];
$parliament = $conn->query("SELECT * FROM `parlament` WHERE `gover` = " . $id)->fetch();
$gover = $conn->query("SELECT * FROM `goverment` WHERE `id` = " . $id)->fetch();

if ($parliament_sql == 0) {
    echo '<div class="block">Парламента не существует<div class="a-down"><a href="../game.php">На главную</a> </div> </div>';
    exit;
}

echo '<div class="block"><div class="block-info">Парламент государства ' . $gover['name'];
$i = 1;
//echo $parliament['sum'];
while ($i <= $parliament['sum']) {
    $users = $conn->query("SELECT * FROM `users` WHERE `id` = " . $parliament[$i])->fetch();
    if ($users['id'] == 0) {
        echo '<div class="block-info">Кресло пустое</div><br>';
    } else {
        echo '<div class="a">' . name($users) . '</div>';
    }
    $i++;
}
$i = 1;
while ($i < 15 AND $user['id'] != $parliament[$i]) {
    if ($user['id'] == $parliament[$i]) {
        $parliament_user = 1;
    }
    $i++;
}
//
if ($parliament_user = 1) {
    echo '<div class="a"><a href="create_law.php?id=' . $id . '">Издать закон</a></div>';
    echo '<div class="a"><a href="laws.php?type=law_vote&id=' . $id . '">Голосовать за закон</a></div>';
}
echo '</div></div>';
echo '<div class="a-down"><a href="/goverment/view.php?id=' . $id . '">Назад</a></div>';