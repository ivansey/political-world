<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$sql = $conn->query("SELECT COUNT(*) FROM `factory`")->fetch()['COUNT(*)']; 
$i = 0;

echo '<div class="block">Работа<br>';
$sum = $conn->query("SELECT COUNT(*) FROM `factory`")->fetch()['COUNT(*)'];
$i = 0;
$i2 = 1;
while($sum >= $i) {
	$sql = $conn->query("SELECT * FROM factory LIMIT " . $i . "," . $i2 . "")->fetch();
	echo '<div class="block">Имя: ' . $sql['name'] . ', тип: ' . $sql['type'] . ', зарплата: ' . $sql['salary'] . ', процент выдаваемого ресурса: ' . $sql['res'];
	echo '
		<div class="a"><a href="factory_viev.php?factory_id=' . $sql['id'] . '">Открыть страницу фабрики</a></div></div><br>
	';
	$i++;
	$i2++;
}
echo '</div>';
echo '<div class="a"><a href="index.php">Назад</a></div>';
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>