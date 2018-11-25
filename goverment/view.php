<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 04.11.18
 * Time: 4:43
 */
include('../system/func.php');
auth();
banned($user);

$id = _num(_string($_GET['id']));

$goverments = $conn->query("SELECT COUNT(*) FROM `goverment` WHERE `id` = " . $id . " ")->fetch()['COUNT(*)'];
if ($goverments == 0) {
    die('<div class="block">Региона нет</div>');
}
$goverment = $conn->query("SELECT * FROM `goverment` WHERE `id` = " . $id . " ")->fetch();
$king_sql = $conn->query("SELECT * FROM `users` WHERE `id` = " . $goverment['king_id'] . " ")->fetch();
$region = $conn->query("SELECT * FROM `regions` WHERE `id` = " . $goverment['pri_reg'] . " ")->fetch();
$king = name($king_sql);

if ($goverment['type'] == 0) {
    $type = 'Презедентская республика';
}

echo '
    <div class="block">
    <div class="block-info">
        Название: ' . $goverment['name'] .  ' <br>
        Глава: ' . $king . ' <br>
        Столица: <a href="../regions/viev.php?id=' . $region['id'] . '">' . $region['name'] .  '</a> <br>
        Строй: ' . $type . ' <br>
    </div>
';
if ($user['gover'] !=  $id) {
    echo '
            <form action="" method="post">
                <div class="a">
                    <input type="submit" name="fly" value="Получить гражданство">
                </div>
            </form>
    ';
}
$party_reg = $conn->query("SELECT * FROM `party` WHERE `id` = " . $user['party'] . " ")->fetch();
if ($party_reg['reg'] == $goverment['pri_reg'] AND $party_reg['gover'] != $goverment['id']) {
    echo '
            <form action="" method="post">
                <div class="a">
                    <input type="submit" name="party_plus" value="Участвовать в политике государства">
                </div>
            </form><br>
    ';
}
if ($king_sql['king_id'] == $user['id']) {
    echo '<div class="a"><a href="create_parlament.php?id=' . $id . '">Создать парламент</a></div>';
}
echo '<div class="a"><a href="/parliament/index.php?id=' . $id . '">Парламент</a></div>';
echo '<div class="a"><a href="elections/index.php?id=' . $id . '">Выборы</a></div>';
if ($_POST['party_plus']) {
    $conn->query("UPDATE `party` SET `gover` = " . $goverment['id'] . " WHERE `id` = " . $user['party'] . " ");
    echo '<div class="block-info">Ваша партия участует в политической жизни государства</div>';
}

if (isset($_POST['fly'])) {
    $conn->query("UPDATE `users` SET `gover` = " . $id . " WHERE `id` = " . $user['id'] . " ");
    header('Location: ?id='.$id.'');
}
/*
 if ($user['priv'] > 2) {
echo '<div class="a"><a href=/delete/delete_region.php?id='.$id.'>Удалить(с. адм.)</a></div>';
}
 if ($user['priv'] > 2) {
echo '<div class="a"><a href=edit.php?id='.$id.'>Изменить(с. адм.)</a></div>';
}
*/
echo '</div><div class="a-down"><a href="../game.php">На главную</a></div>';
?>
