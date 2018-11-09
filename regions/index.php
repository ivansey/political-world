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

if($user[priv] > 2) {
    echo '<br><div class="a"><a href="add.php">Создать регион</a></div>';
}
echo '<div class="a"><a href="../game.php">Главная</a></div>';
echo '<br>';

/*$i=0;
$sum = $conn->query("SELECT COUNT(*) FROM `regions`")->fetch()['COUNT(*)'];
while ($i <= $sum) {
    $reg = $conn->query("SELECT * FROM `regions` LIMIT " . $i . ",1")->fetch();
    echo '<div class="a"><a href="viev.php?id=' . $reg['id'] . '>' . $reg['name'] . '</a></div>';
    $i++;
}*/
$regions = $conn->query("SELECT * FROM `regions`");
while($region=$regions->fetch()){
    echo '<div class="a"><a href="viev.php?id=' . $region['id'] . '">' . $region['name'] . '</a></div>';
}


