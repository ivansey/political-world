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
    die('<div class="block">Региона нет</div>');
}
$region = $conn->query("SELECT * FROM `regions` WHERE `id` = " . $id . " ")->fetch();
$guber_sql = $conn->query("SELECT * FROM `users` WHERE `id` = " . $region['guber'] . " ")->fetch();
$guber = name($guber_sql['name']);
echo '
    <div class="block">
        Название: ' . $region['name'] .  ' <br>
        Губернатор: ' . $guber . ' <br>
    </div>
';
if ($user['region'] !=  $id) {
    echo '
            <form action="" method="post">
                <div class="a">
                    <input type="submit" name="fly" value="Перелёт">
                </div>
            </form>
    ';
}

if (isset($_POST['fly'])) {
    $conn->query("UPDATE `users` SET `region` = " . $id . " WHERE `id` = " . $user['id'] . " ");
    header('Location: ?id='.$id.'');
}
if ($region['gover'] == 0) {
echo '<div class="a"><a href=/goverment/add.php?reg_id='.$region['id'].'>Создать государство</a></div>';
}
 if ($user['priv'] > 2) {
echo '<div class="a"><a href=/delete/delete_region.php?id='.$id.'>Удалить(с. адм.)</a></div>';
}
 if ($user['priv'] > 2) {
echo '<div class="a"><a href=edit.php?id='.$id.'>Изменить(с. адм.)</a></div>';
}
//
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
