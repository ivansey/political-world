<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $work . "'")->fetch();
$exp = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'exp_work'")->fetch();
$material = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'material_factory_" . $factory['type'] . "'")->fetch();
$material_ore = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'ore_factory_" . $factory['type'] . "'")->fetch();

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
	$ore = $material_ore['value'];
	echo $ore;
	$conn->query("UPDATE `users` SET `exp` = `exp` + '" . $exp['value'] . "', `money` = `money` + '" . $factory['salary'] . "',`energy` = `energy`-10 WHERE `id` = '" . $user['id'] . "'");
	if($work == "metal_ore" && $work == "tin_ore" && $work == "oil" && $work == "food") {
		$conn->query("UPDATE `factory` SET `store` = `store` + '" . $material_fab . "', `money` = `money` - `salary` WHERE `id` = '" . $user['work'] . "'");
	}
	if($work == "metal" && $work == "tin" && $work = "steel" && $work = "fuel") {
		if($ore > $factory['ore']) {
			die('Фабрика не сможет начать работу<br><a href="../game.php">В главное меню</a>');
		}
		$query = $conn->prepare('UPDATE `factory` SET `ore` = `ore` - :ore, `store` = `store` + :material, `money` = `money` - `salary` WHERE `id` = :user');
		$query->bindValue(":ore", $material_ore['value']);
		$query->bindValue(":material", $material_ore['value']);
		$query->bindValue(":user", $user['work']);
		$query->execute();
	}
	$conn->query("UPDATE `store` SET `" . $factory['type'] . "` = `" . $factory['type'] . "` + '" . $mater . "' WHERE `id` = '" . $user['id'] . "'");
	$conn->query("UPDATE `factory` SET `store` = `store` + '" . $material_fab . "', `money` = `money` - `salary` WHERE `id` = '" . $user['work'] . "'");
	echo 'Получено денег: ' . $factory['salary'] . ', опыта: ' . $exp['value'] . ', материалов: ' . $mater;
	echo '<br><a href="worker.php">Повторно</a>';
}
echo '<br><a href="index.php">Назад</a>';
echo '<br><a href="../game.php">В главное меню</a>';
