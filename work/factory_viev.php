<?php
include('../system/func.php');
auth();
banned($user);
$id = $_GET['factory_id'];
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = '" . $id . "'")->fetch();
$id_user = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $factory['id_user'] . "'")->fetch();
if(isset($_GET['factory_id'])) {
    echo '<div class="block">';
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
    echo '<br>';
    echo '
	<form action="" method="post"><br>
	<div class="a"><input type="submit" name="work" value="Устроиться на работу"></div> 
	</form>
    ';
    if(isset($_POST['work'])) {
	$conn->query("UPDATE `users` SET `work` = '" . $id . "' WHERE `id` = '" . $user['id'] . "'");
	echo 'Вы теперь работаете';
    }
}else{
    echo 'Такой фабрики нет';
}
echo '</div>';
echo '<div class="a"><a href="index.php">Назад</a></div>';
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
