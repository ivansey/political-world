<?php
include('../system/func.php');
auth();
banned($user);

$sum = $conn->query("SELECT COUNT(*) FROM factory WHERE id_user = '" . $user['id'] . "'")->fetch()['COUNT(*)'];
$i = 0;
$i2 = 1;
while($sum >= $i) {
	$sql = $conn->query("SELECT * FROM factory WHERE id_user = '" . $user['id'] . "' LIMIT " . $i . "," . $i2 . "")->fetch();
	echo '<div class="block">Имя: ' . $sql['name'] . ', тип: ' . $sql['type'];
	echo '
		<div class="a"><a href="user_factory_viev.php?id_factory=' . $sql['id'] . '">Управление</a></div></div><br>
	';
	$i++;
	$i2++;
}
?>