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
		Доступны типы<br>
		metal 50kk RUB<br>
		metal_ore 30kk RUB<br>
		tin 50kk RUB<br>
		tin_ore 30kk RUB<br>
		steel 50kk RUB<br>
		oil 100kk RUB<br>
		fuel 350kk RUB<br>
		food 15kk RUB<br>	
	</form>
';
if(isset($_POST['create'])) {
	//Metal
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
		//Metal Ore
		if($_POST['type'] == 'metal_ore') {
		if($user['money'] < 30000000) {
			echo 'Денежных средств недостаточно';
		}elseif($_POST['res'] > 100 && $_POST['res'] < 0) {
			echo 'Процент выдаваемых ресурсов либо больше ста, либо меньше нуля';
		}else{
			$query = $conn->prepare('UPDATE `users` SET `money` = `money` - 30000000 WHERE `id` = :id');
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
	//Tin
	if($_POST['type'] == 'tin') {
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
		//Tin Ore
		if($_POST['type'] == 'tin_ore') {
		if($user['money'] < 30000000) {
			echo 'Денежных средств недостаточно';
		}elseif($_POST['res'] > 100 && $_POST['res'] < 0) {
			echo 'Процент выдаваемых ресурсов либо больше ста, либо меньше нуля';
		}else{
			$query = $conn->prepare('UPDATE `users` SET `money` = `money` - 30000000 WHERE `id` = :id');
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
		//Steel
		if($_POST['type'] == 'stell') {
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
		//Oil
		if($_POST['type'] == 'oil') {
		if($user['money'] < 100000000) {
			echo 'Денежных средств недостаточно';
		}elseif($_POST['res'] > 100 && $_POST['res'] < 0) {
			echo 'Процент выдаваемых ресурсов либо больше ста, либо меньше нуля';
		}else{
			$query = $conn->prepare('UPDATE `users` SET `money` = `money` - 100000000 WHERE `id` = :id');
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
		//Fuel
		if($_POST['type'] == 'fuel') {
		if($user['money'] < 350000000) {
			echo 'Денежных средств недостаточно';
		}elseif($_POST['res'] > 100 && $_POST['res'] < 0) {
			echo 'Процент выдаваемых ресурсов либо больше ста, либо меньше нуля';
		}else{
			$query = $conn->prepare('UPDATE `users` SET `money` = `money` - 350000000 WHERE `id` = :id');
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
		//Food
		if($_POST['type'] == 'food') {
		if($user['money'] < 15000000) {
			echo 'Денежных средств недостаточно';
		}elseif($_POST['res'] > 100 && $_POST['res'] < 0) {
			echo 'Процент выдаваемых ресурсов либо больше ста, либо меньше нуля';
		}else{
			$query = $conn->prepare('UPDATE `users` SET `money` = `money` - 15000000 WHERE `id` = :id');
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
echo '<br><a href="index.php">На работу</a>';
echo '<a href="../game.php">На главную</a><br>';
?>
