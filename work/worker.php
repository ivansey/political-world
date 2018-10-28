<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $work . "'")->fetch();
$exp = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'exp_work'")->fetch();
$material = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'material_factory_" . $factory['type'] . "'")->fetch();

if($work == 0) {
	echo 'Вы не работаете';
}else{
	if($user['energy'] <= 0) {
		die('Не хватает энергии');
	}
	if($factory['money'] < $factory['salary']) {
		die('Фабрика не сможет выдать зарплату');
	}
	$res = $factory['res'];
	$mater = $material['value'] * $res / 100;
	$material_fab = $material['value'] - $mater;
	$conn->query("UPDATE `users` SET `exp` = `exp` + '" . $exp['value'] . "', `money` = `money` + '" . $factory['salary'] . "',`energy` = `energy`-10 WHERE `id` = '" . $user['id'] . "'");
	$conn->query("UPDATE `store` SET `" . $factory['type'] . "` = `" . $factory['type'] . "` + '" . $mater . "' WHERE `id` = '" . $user['id'] . "'");
	$conn->query("UPDATE `factory` SET `store` = `store` + '" . $material_fab . "', `money` = `money` - `salary` WHERE `id` = '" . $user['work'] . "'");
	echo 'Получено денег: ' . $factory['salary'] . ', опыта: ' . $exp['value'] . ', материалов: ' . $mater;
	echo '<br><a href="worker.php">Повторно</a>';
}
echo '<br><a href="index.php">Назад</a>';
echo '<br><a href="../game.php">В главное меню</a>';
