<?php
include('../system/func.php');
auth();
banned($user);

$work = $user['work'];
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $work . "'")->fetch();
$id_user = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $factory['leader'] . "'")->fetch();
$nnn = name($id_user);
$ftype = $conn->query("SELECT * FROM `factory_types` WHERE `res` = '" . $factory['type'] . "'")->fetch();
echo '
	<div class="block-up">
';
if($work == 0) {
	echo '
		<form action="find_work.php" method="post">
		<div class="a"><input type="submit" name="find" value="Поиск работы"></div> 
		</form>
	';

}else{
	echo 'Имя: ';
    echo $factory['name'];
    echo '<br>';
    echo 'Тип: ';
    echo $ftype['name'];
    echo '<br>';
    echo 'Зарплата: ';
    echo $factory['salary_money'];
    echo '<br>';
    echo 'Процент выдаваемого ресурса: ';
    echo $factory['salary_res'];
    echo '<br>';
    echo 'Владелец: ';
    echo $nnn;
    echo '<br>
		<form action="worker.php" method="post">
			<br><input type="submit" name="work" value="Работать">
		</form>  
		<form action="" method="post">
	        <input type="submit" name="del" value="Уволиться">
		</form>
	';
	if(isset($_POST['del'])) {
		$conn->query("UPDATE users SET work = 0 WHERE id = " . $user['id'] . " ");
		echo '<div class="block-up">Вы уволены</div><br>';
	}
}
echo '
		<form action="create_factory.php" method="post">
		<input type="submit" name="create" value="Создание фабрики">
		</form>
	';
$factory_sql = $conn->query("SELECT COUNT(*) FROM `factory` WHERE `leader` = '" . $user['id'] . "'")->fetch()['COUNT(*)'];
$factory_sql2 = $conn->query("SELECT * FROM `factory` WHERE `leader` = '" . $user['id'] . "'")->fetch();
if($factory_sql > 0) {
	echo '
		<form action="factory_viever.php" method="post">
		<input type="submit" name="create" value="Управление фабриками">
		<br>
		</form>
	';
}
echo '</div><div class="a-down"><a href="../game.php">На главную</a></div>';
?>
