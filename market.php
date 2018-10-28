<?php
include('system/func.php');
auth();
banned($user);
echo '<a href="new_market.php">Создать предложение</a><br>';
$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . "")->fetch();
$sum = $conn->query("SELECT COUNT(*) FROM `market`")->fetch()['COUNT(*)'];
$i = 0;
$i2 = 1;
while($i <= $sum) {
	$i++;
	$i2++;
	$market = $conn->query("SELECT * FROM `market` LIMIT " . $i . "," . $i2 . "")->fetch();
	echo 'ID: ' . $market['id_user'] . ', тип: ' . $market['type'] . ', цена:' . $market['price'] . ', кол-во:' . $market['res'];
	echo '
		<form action="buy_market.php" method="post">
			<input type="text" name="res"> 
			<input type="submit" name="buy" value="Купить">
		</form>
	';
	
}
echo '<a href="game.php">На главную</a>';
?>