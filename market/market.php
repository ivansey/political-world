<?php
include('../system/func.php');
auth();
banned($user);
echo '<div class="a-up"><a href="index.php">На главную</a></div>';
$type = $_GET['id'];
$resource= $conn->query("SELECT * FROM resourse WHERE id = $type")->fetch();

if($resource['name'] == ''){
die('<div class="block-middle">Ресурс не найден</div>');
}

$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
$sum = $conn->query("SELECT COUNT(*) FROM `market` WHERE `type` = '" . $type . "'")->fetch()['COUNT(*)'];

if ($sum == 0) {
    echo('<div class="block-middle">Предложений на рынке нет</div>');
    } else {
    echo '<div class="block-middle">';
  $sqlet = $conn->query("SELECT * FROM `market` WHERE `type` = '" . $type . "' ORDER BY `price` ASC");
while($market=$sqlet->fetch()){
$ress = $conn->query("SELECT * FROM resourse WHERE id = $market[type]")->fetch();
echo '<div class="block-info">ID: ' .
$market['id_user'] . ', тип: ' . $ress['name'] . ', цена:' . $market['price'] . ', кол-во:' . $market['res'];
        echo '
		<form action="buy_market.php?id=' . $market['id'] . '" method="post">
			<input type="text" name="res"> 
			<input type="submit" name="buy" value="Купить">
		</form>
		</div>
	';
}
}
echo '</div><div class="a-down"><a href="new_market.php">Создать предложение</a><br></div>';
