<?php
include('system/func.php');
auth();
banned($user);
echo '<div class="a"><a href="new_market.php">Создать предложение</a><br></div>';
echo '
    <form action="" method="post">
    <div class="a"><input type="submit" name="sort" value="Сортировать"></div><br>
    </form>
    
';
if (isset($_POST['sort'])) {
    echo '
    <div class="block">
    <form action="" method="post">
    <div class="a"><input type="submit" name="sort" value="По возрастанию цены"></div><br> 
    <div class="block>" По типу<br>
    <div class="a"><input type="text" name="type"><br>
    <input type="submit" name="sort_type" value="По типу"></div><br>
    </form>
    </div>
    </div>
';
}
    $store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
    $sum = $conn->query("SELECT COUNT(*) FROM `market`")->fetch()['COUNT(*)'];
    $i = 0;
    $i2 = 1;
    while ($i <= $sum) {
        $i++;
        $i2++;
        $market = $conn->query("SELECT * FROM `market` LIMIT " . $i . "," . $i2 . " ")->fetch();
        echo '<div class="block">ID: ' . $market['id_user'] . ', тип: ' . $market['type'] . ', цена:' . $market['price'] . ', кол-во:' . $market['res'];
        echo '
		<form action="buy_market.php?id=' . $market['id'] . '" method="post">
			<div class="a"> <input type="text" name="res"> 
			<input type="submit" name="buy" value="Купить"></div>
		</form>
		</div>
	';
}
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
echo '<div class="a"><a href="game.php">На главную</a></div>';
?>