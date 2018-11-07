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
$king = name($king_sql['name']);
echo '
    <div class="block">
        Название: ' . $goverment['name'] .  ' <br>
        Глава: ' . $king . ' <br>
        Столица: <a href="../regions/viev.php?id=' . $region['id'] . '">' . $region['name'] .  ' <br>
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
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
