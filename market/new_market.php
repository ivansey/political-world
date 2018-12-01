<?php
include('../system/func.php');
auth();
banned($user);
$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ")->fetch();
echo '
        <div class="block">
		<form action="" method="post">
			Тип ресурсов:<br>
			<select name="type">';
$ress = $conn->query("SELECT * FROM `resource`");
while($res=$ress->fetch()){
echo "<div class='block'> <option value=$res[id]>$res[name]</option>";
}
        echo '</select><br> 
			Количество ресурса<br>
			<input type="text" name="res"><br>
			Цена за единицу<br>
			<input type="text" name="price"><br>
			<div class="a"><input type="submit" name="add" value="Разместить"></div><br>
		</form>
		</div>
';
//if($_POST['type'] == 'metal') {
	$type = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " AND type = $_POST[type] ")->fetch();
	if(isset($_POST['add'])) {
		if($_POST['res'] > $type[sum]) {
			die('<div class="block">Недостаточно ресурсов</div><br><div class="a"><a href="market.php">На главную</a></div>');
		}
	$conn->query("UPDATE `store` SET `sum` = `sum` - $_POST[res] WHERE `id` = $user[id] AND `type`=  $_POST[type]");
	$conn->query("INSERT INTO `market` SET `id_user` = " . $user['id'] . ", `type` = '" . $_POST['type'] . "', `res` = " . $_POST['res'] . ", `price` = " . $_POST['price'] . " ");
	echo '<br><div class="block">Предложение отправлено</div><br>';
}
//}
echo '<div class="a"><a href="market.php?id='.$_POST[type].'">Назад</a><br></div>';
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
