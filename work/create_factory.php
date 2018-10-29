<?php
include('../system/func.php');
auth();
banned($user);

$work = $user['work'];

echo '
	Создание фабрики<br>
	<form action="" method="post">
		Имя:<br>
		<input type="text" name="name"><br>
		Добываемый ресурс<br>
		<input type="text" name="type"><br>
		Выдаваемая зарплата<br>
		<input type="text" name="salary"><br>
		Выдаваемый процент ресурсов<br>
		<input type="text" name="res"><br>
		<input type="submit" name="create" value="Создать"><br>
		Доступен только тип metal
	</form>
';
if(isset($_POST['create'])) {
	if($_POST['type'] == 'metal') {
		if($user['money'] < 50000000) {
			echo 'Денежных средств недостаточно';
		}elseif($_POST['res'] > 100 && $_POST['res'] < 0) {
			echo 'Процент выдаваемых ресурсов либо больше ста, либо меньше нуля';
		}else{
			$query = $conn->prepare('UPDATE `users` SET `money` = `money` - 50000000 WHERE `id` = :id');
			$query->bindValue(":id", $user['id']);
			$query->execute();
			$query = $conn->prepare('INSERT `factory` SET `name` = :name, `type` = :type, `salary` = :salary, `res` = :res, `money` = 10000000, `id_user` = :id_user');
			$query->bindValue(":name", $_POST['name']);
			$query->bindValue(":type", $_POST['type']);
			$query->bindValue(":salary", $_POST['salary']);
			$query->bindValue(":res", $_POST['res']);
			$query->bindValue(":id_user", $user['id']);
			$query->execute();
			echo 'Фабрика создана';
		}
		
	}
	 
}
echo '<br><a href="index.php">На работу</a>';
echo '<a href="../game.php">На главную</a><br>';
?>
