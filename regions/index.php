<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 03.11.18
 * Time: 11:01
 */
include("../system/func.php");
auth();
banned($user);
$i=0;
$sum = $conn->query("SELECT COUNT(*) FROM `regions`")->fetch()['COUNT(*)'];
while ($i <= $sum) {
    $i++;
    $reg = $conn->query("SELECT COUNT(*) FROM `regions` LIMIT " . $i . ",1 ")->fetch();
    echo '<div class="a"><a href="region.php?id=' . $reg['id'] . '>' . $reg['name'] . '</a></div>';
}

echo '<div class="a"><a href="../game.php">Главная</a></div>';