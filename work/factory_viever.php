<?php
include('../system/func.php');
auth();
banned($user);

	$sql = $conn->query("SELECT * FROM factory WHERE leader = '" . $user['id'] . "'");
while($sqll=$sql->fetch()){
$ftype = $conn->query("SELECT * FROM `factory_types` WHERE `res` = '" . $sqll['type'] . "'")->fetch();
	echo '<div class="block">Имя: ' . $sqll['name'] . ', тип: ' . $ftype['name'];
	echo '
		<div class="a"><a href="user_factory_viev.php?id_factory=' . $sqll['id'] . '">Управление</a></div></div><br>
	';
}
echo '<div class="a"><a href="index.php">Назад</a></div>';
?>
