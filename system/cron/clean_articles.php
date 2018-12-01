<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 03.11.18
 * Time: 15:32
 */
include('../system/func.php');
$sum = strtotime(date('d')) + strtotime('0000-00-01') - strtotime('0000-00-00 00:00:00');
$time_plus = date('Y-m-d H:i:s', $sum);
echo $time_plus;
//Скрипт очистки рынка от пустых предложений
$conn->query("DELETE FROM `articles` WHERE `time` < " . $time_plus . " ");
?>