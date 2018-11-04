<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 03.11.18
 * Time: 15:32
 */
include('func.php');
$sum = date('d') + 1;
$time_plus = date('Y-m-d H:i:s') + $sum;
echo $time_plus;
//Скрипт очистки рынка от пустых предложений
$conn->query("DELETE FROM `articles` WHERE `time` < " . $time_plus . " ");
?>