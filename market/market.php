<?php
include('../system/func.php');
auth();
banned($user);
echo '<div class="a"><a href="index.php">На главную</a></div><br>';
$type = $_GET['type'];
echo '<div class="a"><a href="new_market.php">Создать предложение</a><br></div>';
$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
$sum = $conn->query("SELECT COUNT(*) FROM `market` WHERE `type` = '" . $type . "'")->fetch()['COUNT(*)'];

if ($sum == 0) {
    die('<div class="block">Предложений на рынке нет</div>');
    } else {
  $sqlet = $conn->query("SELECT * FROM `market` WHERE `type` = '" . $type . "' ORDER BY `price` ASC");
while($market=$sqlet->fetch()){
echo '<div class="block">ID: ' . $market['id_user'] . ', тип: ' . $market['type'] . ', цена:' . $market['price'] . ', кол-во:' . $market['res'];
        echo '
		<form action="buy_market.php?id=' . $market['id'] . '" method="post">
			<div class="a"> <input type="text" name="res"> 
			<input type="submit" name="buy" value="Купить"></div>
		</form>
		</div>
	';
}
}

?>
