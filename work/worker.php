<?php
include('../system/func.php');
auth();
banned($user);
echo '<div class="block">';
$work = $user['work'];
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $work . "'")->fetch();
$exp = $conn->query("SELECT * FROM `parametr` WHERE `type` = '0'")->fetch();
$material_income = $conn->query("SELECT * FROM `parametr` WHERE `type` = $factory[type] ")->fetch();
$type = $factory['type'];

if ($work == 0) {
    echo 'Вы не работаете';
} else {
    if ($user['energy'] <= 0) {
        die('Не хватает энергии');
    }
    if ($factory['budget_money'] < $factory['salary_money']) {
        die('Фабрика не сможет выдать зарплату');
    }
}
    $res = $factory['salary_res'];
    $mater = $material_income['value'] * $res / 100;
    $material_fab = $material_income['value'] - $mater;
    $conn->query("UPDATE `users` SET `exp` = `exp` + '" . $exp['value'] . "', `money` = `money` + '" . $factory['salary_money'] . "',`energy` = `energy`-10 WHERE `id` = '" . $user['id'] . "'");
        $conn->query("UPDATE `factory` SET `budget_res` = `budget_res` + '" . $material_fab . "', `budget_money` = `budget_money` - `salary_money` WHERE `id` = '" . $user['work'] . "'");
//
$suka = $conn->query("SELECT * FROM `store` WHERE `id` = $user[id] AND `type` = $type")->fetch();
if($suka[sum] == '') {
$query = $conn->prepare('INSERT `store` SET `type` = :type, `id` = :id, `sum`= 0 ');
            $query->bindValue(":type", $type);
            $query->bindValue(":id", $user[id]);
            $query->execute();
 $conn->query("UPDATE `store` SET `sum` = `sum` + $mater WHERE `id` = $user[id] AND `type` = $type");
} else {
 $conn->query("UPDATE `store` SET `sum` = `sum` + $mater WHERE `id` = $user[id] AND `type` = $type");
}
//
    echo 'Получено денег: ' . $factory['salary_money'] . ', опыта: ' . $exp['value'] . ', материалов: ' . $mater;
    echo '<br><div class="a"><a href="worker.php">Повторно</a></div>';
echo '</div>';
echo '<br><div class="a"><a href="index.php">Назад</a></div>';
echo '<div class="a"><a href="../game.php">В главное меню</a></div>';

?>
