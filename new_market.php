<?php
include('system/func.php');
auth();
banned($user);
$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . "")->fetch();
echo '
		<form action="" method="post">
			Тип ресурсов:<br>
			<input type="text" name="type"><br> 
			Количество ресурса<br>
			<input type="text" name="res"><br>
			Цена за единицу<br>
			<input type="text" name="price"><br>
			<input type="submit" name="add" value="Разместить"><br>
		</form>
		<iframe scr="store.php" wight=300 height=200></iframe><br>
';
if($_POST['type'] == 'metal') {
	$type = $store['metal'];
	if(isset($_POST['add'])) {
		if($_POST['res'] > $type) {
			die('Недостаточно ресурсов<br><a href="market.php">На главную</a>');
		}
	$conn->query("UPDATE `store` SET `" . $_POST['type'] . "` = `" . $_POST['type'] . "` - " . $_POST['res'] . " WHERE `id` = " . $user['id'] . "");
	$conn->query("INSERT `market` SET `id_user` = " . $user['id'] . ", `type` = '" . $_POST['type'] . "', `res` = " . $_POST['res'] . ", `price` = " . $_POST['price'] . "");
	echo 'Предложение отправлено';
}
}
echo '<a href="market.php">Назад</a><br>';
echo '<a href="game.php">На главную</a>';
?>