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

$regions = $conn->query("SELECT COUNT(*) FROM `regions` WHERE `id` = " . $id . " ")->fetch()['COUNT(*)'];
if ($regions == 0) {
    die('<div class="block-up">Региона нет</div>');
}
$region = $conn->query("SELECT * FROM `regions` WHERE `id` = " . $id . " ")->fetch();
$gover = $conn->query("SELECT * FROM `goverment` WHERE `id` = " . $region['gover'] . " ")->fetch();
$guber_sql = $conn->query("SELECT * FROM `users` WHERE `id` = " . $region['guber'] . " ")->fetch();
$guber = name($guber_sql);
echo '
    <div class="block-up">
        <div class="block-info">
        Название: ' . $region['name'] . ' <br><br>
        Государство: <a href="../goverment/view.php?id=' . $gover['id'] . '">' . $gover['name'] . '</a>
        </div>
        <br><div class="block-info">
        Губернатор: ' . $guber . '
        </div><br>
    
';
if ($user['region'] != $id) {
    echo '
            <form action="" method="post">
                    <input type="submit" name="fly" value="Перелёт">
            </form>
    ';
}

if (isset($_POST['fly'])) {
    $conn->query("UPDATE `users` SET `region` = " . $id . " WHERE `id` = " . $user['id'] . " ");
    header('Location: ?id=' . $id . '');
}
$king_sql = $conn->query("SELECT COUNT(*) FROM `goverment` WHERE `king_id` = " . $user['id'] . " ")->fetch()['COUNT(*)'];
if ($region['gover'] == 0 AND $king_sql == 0) {
    echo '<div class="a"><a href=../goverment/add.php?reg_id=' . $region['id'] . '>Создать государство</a></div>';
}
if ($user['priv'] > 2) {
    echo '<div class="a"><a href=../delete/delete_region.php?id=' . $id . '>Удалить(с. адм.)</a></div>';
}
if ($user['priv'] > 2) {
    echo '<div class="a"><a href=edit.php?id=' . $id . '>Изменить(с. адм.)</a></div>';
}
echo '</div>';
echo '<div class="a-down"><a href="../game.php">На главную</a></div>';
?>
