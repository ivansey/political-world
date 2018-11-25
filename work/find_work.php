<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$sql = $conn->query("SELECT COUNT(*) FROM `factory`")->fetch()['COUNT(*)']; 
$i = 0;

echo '<div class="block">';
$sqle = $conn->query("SELECT * FROM `factory`");
while($sql=$sqle->fetch()){
$ftype = $conn->query("SELECT * FROM `factory_types` WHERE `res` = '" . $sql['type'] . "'")->fetch();
echo '<div class="block">Имя: ' . $sql['name'] . ', тип: ' . $ftype['name'] . ', зарплата: ' . $sql['salary_money'] . ', процент выдаваемого ресурса: ' . $sql['salary_res'];
	echo '
		<div class="a"><a href="factory_viev.php?factory_id=' . $sql['id'] . '">Открыть страницу фабрики</a></div></div><br>
	';
}
echo '</div>';
echo '<div class="a"><a href="index.php">Назад</a></div>';
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
