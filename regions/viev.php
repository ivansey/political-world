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
echo '
    <div class="block">
        Название: ' . $region['name'] .  ' <br>
    </div>
';
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>