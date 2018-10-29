<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$sql = $conn->query("SELECT COUNT(*) FROM `factory`")->fetch()['COUNT(*)']; 
$i = 0;

echo 'Работа<br>';
$sum = $conn->query("SELECT COUNT(*) FROM `factory`")->fetch()['COUNT(*)'];
$i = 0;
$i2 = 1;
while($sum >= $i) {
	$sql = $conn->query("SELECT * FROM factory LIMIT " . $i . "," . $i2 . "")->fetch();
	echo 'Имя: ' . $sql['name'] . ', тип: ' . $sql['type'] . ', зарплата: ' . $sql['salary'] . ', процент выдаваемого ресурса: ' . $sql['res'];
	echo '
		<br><a href="factory_viev.php?factory_id=' . $sql['id'] . '">Открыть страницу фабрики</a><br>
	';
	$i++;
	$i2++;
}
echo '<a href="index.php">Назад</a<br>';
echo '<a href="../game.php">На главную</a>';
?>