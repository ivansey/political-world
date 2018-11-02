<?php
include('../system/func.php');
auth();
banned($user);
$work = $user['work'];
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $work . "'")->fetch();
$id_user = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $factory['id'] . "'")->fetch();

echo '
	<div class="block"> Работа<br>
';
if($work == 0) {
	echo '
		Найдите работу<br>
		<form action="find_work.php" method="post">
		<div class="a"><input type="submit" name="find" value="Поиск работы"></div> 
		<br>
		</form>
	';

}else{
	echo 'Имя ';
    echo $factory['name'];
    echo '<br>';
    echo 'Тип ';
    echo $factory['type'];
    echo '<br>';
    echo 'Зарплата ';
    echo $factory['salary'];
    echo '<br>';
    echo 'Процент выдаваемого ресурса ';
    echo $factory['res'];
    echo '<br>';
    echo 'Владелец ';
    echo $id_user['name'];
    echo '<br>
		<form action="worker.php" method="post">
			<br><div class="a"><input type="submit" name="work" value="Работать"></div><br>
		</form>  
		<form action="" method="post">
			<br><div class="a"><input type="submit" name="del" value="Уволиться"></div><br>
		</form>
	';
	if(isset($_POST['del'])) {
		$conn->query("UPDATE users SET work = 0 WHERE id = " . $user['id'] . " ");
		echo 'Вы уволены<br>';
	}
}
echo '</div>';
echo '
        <div class="block">
		<form action="create_factory.php" method="post">
		<div class="a"><input type="submit" name="create" value="Создание фабрики"></div>
		<br>
		</form>
	';
$factory_sql = $conn->query("SELECT COUNT(*) FROM `factory` WHERE `id_user` = '" . $user['id'] . "'")->fetch()['COUNT(*)'];
$factory_sql2 = $conn->query("SELECT * FROM `factory` WHERE `id_user` = '" . $user['id'] . "'")->fetch();
if($factory_sql > 0) {
	echo '<iframe src="factory_viever.php" wight=300 height=400></iframe><br></div>';
}
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
	
    
