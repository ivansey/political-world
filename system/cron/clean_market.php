<?php
include('../func.php');
//Скрипт очистки рынка от пустых предложений
$conn->query("DELETE FROM `market` WHERE `res` <= 0");
?>