<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$sql = $conn->query("SELECT COUNT(*) FROM `factory`")->fetch()['COUNT(*)']; 
$i = 0;

echo 'Работа';
while($i < $sql) {
	$i++;
	$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $i . "'")->fetch();
	echo ($factory['name'] . ' ' . $factory['type'] . ' ' . $factory['salary'] . ' <a href="' . 'factory_viev.php?factory_id=' . $factory['id'] . '">Открыть страницу фабрики</a><br>');
}
echo '<a href="index.php">Назад</a<br>';
echo '<a href="../game.php">На главную</a>';
?>
    
    
