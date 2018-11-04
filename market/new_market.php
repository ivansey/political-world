<?php
include('system/func.php');
auth();
banned($user);
$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
echo '
        <div class="block">
		<form action="" method="post">
			Тип ресурсов:<br>
			<input type="text" name="type"><br> 
			Количество ресурса<br>
			<input type="text" name="res"><br>
			Цена за единицу<br>
			<input type="text" name="price"><br>
			<div class="a"><input type="submit" name="add" value="Разместить"></div><br>
		</form>
		<iframe scr="index.php" wight=300 height=200></iframe><br></div>
';
//if($_POST['type'] == 'metal') {
	$type = $store[$_POST['type']];
	if(isset($_POST['add'])) {
		if($_POST['res'] > $type) {
			die('<div class="block">Недостаточно ресурсов</div><br><div class="a"><a href="market.php">На главную</a></div>');
		}
	$conn->query("UPDATE `store` SET `" . $_POST['type'] . "` = `" . $_POST['type'] . "` - " . $_POST['res'] . " WHERE `id` = " . $user['id'] . " ");
	$conn->query("INSERT INTO `market` SET `id_user` = " . $user['id'] . ", `type` = '" . $_POST['type'] . "', `res` = " . $_POST['res'] . ", `price` = " . $_POST['price'] . " ");
	echo 'Предложение отправлено';
}
//}
echo '<div class="a"><a href="market.php">Назад</a><br></div>';
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>