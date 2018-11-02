<?php
include('system/func.php');
auth();
banned($user);
$type = $_GET['type'];
echo '<div class="a"><a href="new_market.php">Создать предложение</a><br></div>';
$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
$sum = $conn->query("SELECT COUNT(*) FROM `market` WHERE `type` = '" . $type . "'")->fetch()['COUNT(*)'];

if ($sum == 0) {
    die('<div class="block">Предложений на рынке нет</div>');
    } else {
    $i = 0;
    //$i2 = 1;
    while ($i <= $sum) {

        //$i2++;
        $market = $conn->query("SELECT * FROM `market` WHERE `type` = '" . $type . "' ORDER BY `price` ASC LIMIT " . $i . ",1 ")->fetch();
        echo '<div class="block">ID: ' . $market['id_user'] . ', тип: ' . $market['type'] . ', цена:' . $market['price'] . ', кол-во:' . $market['res'];
        echo '
		<form action="buy_market.php?id=' . $market['id'] . '" method="post">
			<div class="a"> <input type="text" name="res"> 
			<input type="submit" name="buy" value="Купить"></div>
		</form>
		</div>
	';
        $i++;
    }
}
/*if (isset($_POST['sort_type'])) {
    $store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
    $sum = $conn->query("SELECT COUNT(*) FROM `market`")->fetch()['COUNT(*)'];
    $i = 0;
    $i2 = 1;
    while ($i = $sum) {
        $i++;
        $i2++;
        $market = $conn->query("SELECT * FROM `market` ORDER BY `price` LIMIT " . $i . ",1 ")->fetch();
        echo '<div class="block">ID: ' . $market['id_user'] . ', тип: ' . $market['type'] . ', цена:' . $market['price'] . ', кол-во:' . $market['res'];
        echo '
		<form action="buy_market.php?id=' . $market['id'] . '" method="post">
			<div class="a"> <input type="text" name="res"> 
			<input type="submit" name="buy" value="Купить"></div>
		</form>
		</div>
	';
    }
}*/
/*$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
$sum = $conn->query("SELECT COUNT(*) FROM `market`")->fetch()['COUNT(*)'];
$i = 0;
$i2 = 1;
while ($i <= $sum) {
    $i++;
    $i2++;
    $market = $conn->query("SELECT * FROM `market` LIMIT " . $i . "," . $i2 . " ")->fetch();
    echo 'ID: ' . $market['id_user'] . ', тип: ' . $market['type'] . ', цена:' . $market['price'] . ', кол-во:' . $market['res'];
    echo '
    <div class="block">
		<form action="buy_market.php?id=' . $market['id'] . '" method="post">
			<input type="text" name="res"> 
			<input type="submit" name="buy" value="Купить">
		</form></div>
	';

}*/
echo '<div class="a"><a href="select_market.php">На главную</a></div>';
?>