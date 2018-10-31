<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $work . "'")->fetch();
$exp = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'exp_work'")->fetch();
$material = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'material_factory_" . $factory['type'] . "'")->fetch();
$material_ore = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'ore_factory_" . $factory['type'] . "'")->fetch();
$material_ore2 = $conn->query("SELECT * FROM `parametr` WHERE `name` = 'ore2_factory_" . $factory['type'] . "'")->fetch();
$type = $factory['type'];

if ($work == 0) {
    echo 'Вы не работаете';
} else {
    if ($user['energy'] <= 0) {
        die('Не хватает энергии');
    }
    if ($factory['money'] < $factory['salary']) {
        die('Фабрика не сможет выдать зарплату');
    }
    $res = $factory['res'];
    $mater = $material['value'] * $res / 100;
    $material_fab = $material['value'] - $mater;
    $ore = $material_ore['value'];
    $ore2 = $material_ore2['value'];
    $conn->query("UPDATE `users` SET `exp` = `exp` + '" . $exp['value'] . "', `money` = `money` + '" . $factory['salary'] . "',`energy` = `energy`-10 WHERE `id` = '" . $user['id'] . "'");
    if (($type == "metal_ore") OR ($type == "tin_ore") OR ($type == "oil") OR ($type == "food")) {
        $conn->query("UPDATE `factory` SET `store` = `store` + '" . $material_fab . "', `money` = `money` - `salary` WHERE `id` = '" . $user['work'] . "'");
    }
    if (($type == "tin") OR ($type == "metal") OR ($type == "fuel")) {
        if ($ore > $factory['ore']) {
            die('Фабрика не сможет начать работу<br><a href="../game.php">В главное меню</a>');
        }
        $query = $conn->prepare('UPDATE factory SET ore = ore - :ore, store = store + :material, money = money - salary WHERE id = :user');
        $query->bindValue(":material", $material_fab);
        $query->bindValue(":ore", $ore);
        $query->bindValue(":user", $work);
        $query->execute();
    }
    if ($type == "steel") {
        if ($ore > $factory['ore']) {
            die('Фабрика не сможет начать работу<br><a href="../game.php">В главное меню</a>');
        }
        if ($ore2 > $factory['ore2']) {
            die('Фабрика не сможет начать работу<br><a href="../game.php">В главное меню</a>');
        }
        $query = $conn->prepare('UPDATE factory SET ore = ore - :ore, ore2 = ore2 - :ore2, store = store + :material, money = money - salary WHERE id = :user');
        $query->bindValue(":material", $material_fab);
        $query->bindValue(":ore", $ore);
        $query->bindValue(":ore2", $ore2);
        $query->bindValue(":user", $work);
        $query->execute();
    }
    $conn->query("UPDATE `store` SET `" . $factory['type'] . "` = `" . $factory['type'] . "` + '" . $mater . "' WHERE `id` = '" . $user['id'] . "'");
    //$conn->query("UPDATE `factory` SET `store` = `store` + '" . $material_fab . "', `money` = `money` - `salary` WHERE `id` = '" . $user['work'] . "'");
    echo 'Получено денег: ' . $factory['salary'] . ', опыта: ' . $exp['value'] . ', материалов: ' . $mater;
    echo '<br><a href="worker.php">Повторно</a>';
}
echo '<br><a href="index.php">Назад</a>';
echo '<br><a href="../game.php">В главное меню</a>';
