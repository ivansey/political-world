<?php
include('system/func.php');
auth();
banned($user);
if(isset($_POST['buy'])) {
		$money = $market['price'] * $_POST['res'];
		$type = $factory['type'];
		$res = $_POST['res'];
		if($money > $user['money']) {
			die('Нехватает денег<br><a href="game.php">На главную</a>');
		}
		if($res > $market['res']) {
			die('У продавца столько товара нет<br><a href="game.php">На главную</a>');
		}
		$conn->query("UPDATE `users` SET `money` = `money` - '" . $money . "' WHERE `id` = '" . $user['id'] . "'");
		$conn->query("UPDATE `users` SET `money` = `money` + '" . $money . "' WHERE `id` = '" . $market['id_user'] . "'");
		if($type = 'metal') {
			$conn->query("UPDATE `store` SET `metal` = `metal` + '" . $_POST['res'] . "' WHERE `id` = '" . $user['id'] . "'");
			$conn->query("UPDATE `market` SET `res` = `res` - '" . $_POST['res'] . "' WHERE `id` = '" . $market['id'] . "'");
		}
		//$conn->query("UPDATE `store` SET `" . $type . "` = `" . $type . "` + '" . $_POST['res'] . "' WHERE `id` = '" . $user['id'] . "'");
		//$conn->query("UPDATE `store` SET `" . $type . "` = `" . $type . "` - '" . $_POST['res'] . "' WHERE `id` = '" . $market['id_user'] . "'");
		if($market['res'] <= 0) {
			$conn->query("DELETE FROM `market` WHERE `id` = " . $market['id'] . "");
		}
		echo 'Транзакция завершена<br>';
	}		
echo '<a href="market.php">Назад</a>';
echo '<a href="game.php">На главную</a>';
?>