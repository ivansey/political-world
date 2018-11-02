<?php
include('../system/func.php');
auth();
banned($user);
echo '<div class="block">';
//Переменные и вывод ошибок
$id_factory = $_GET['id_factory'];
$factory_sql = $conn->query("SELECT COUNT(*) FROM `factory` WHERE `id_user` = " . $user['id'] . "")->fetch()['COUNT(*)'];
if ($factory_sql == 0) {
    die('У вас нет фабрик');
}
$factory_sql = $conn->query("SELECT COUNT(*) FROM `factory` WHERE `id` = " . $id_factory . "")->fetch()['COUNT(*)'];
if ($factory_sql == 0) {
    echo 'У вас нет фабрики';
    die('<div class="a"><a href="../game.php">На главную</a></div> ');
}
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = " . $id_factory . "")->fetch();
$user_store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . "")->fetch();
$type = $factory['type'];
//Переменные для переработчиков
if ($type == "metal") {
    $type_ore = "metal_ore";
    $type_num = 1;
    $store_ore = $user_store['metal_ore'];
}
if ($type == "tin") {
    $type_ore = "tin_ore";
    $type_num = 1;
    $store_ore = $user_store['tin_ore'];
}
if ($type == "fuel") {
    $type_ore = "oil";
    $type_num = 1;
    $store_ore = $user_store['oil'];
}
if ($type == "steel") {
    $type_ore = "metal";
    $type_ore2 = "tin";
    $type_num = 2;
    $store_ore = $user_store['metal'];
    $store_ore2 = $user_store['tin'];
}
//Формы
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
echo $user['name'];
echo '<br>';
echo 'Остаток денежных средств: ' . $factory['money'] . '<br>';
echo 'Готовых материалов на складе: ' . $factory['store'] . '<br>';
//Формы для переработчиков
if ($type_num == 1) {
    echo 'Сырья на складе: ' . $factory['ore'] . '<br>';
}
if ($type_num == 2) {
    echo 'Второго сырья на складе: ' . $factory['ore2'] . '<br>';
}
//Кнопка появления форм редактирования
echo '
	<form action="" method="post"><br>
		<div class="a"><input type="submit" name="edit" value="Редактировать"></div>
	</form>
    ';
//Формы редактирования
if (isset($_POST['edit'])) {
    echo '
		<form action="" method="post"><br>
		    <div class="block">
			Имя фабрики<br>
				<input type="text" name="name"><br>
				<div class="a"><input type="submit" name="edit_name" value="Редактировать"></div><br>
				</div>
			<div class="block">
			Выдаваемая зарплата<br>
				<input type="text" name="salary"><br>
				<div class="a"><input type="submit" name="edit_salary" value="Редактировать"></div><br>
				</div>
			<div class="block">
			Выдаваемый процент ресурса<br>
				<input type="text" name="res"><br>
				<div class="a"><input type="submit" name="edit_res" value="Редактировать"></div><br>
				</div>
				<br>
			<div class="block">
			Начислить денег на счёт фабрики<br>
				<input type="text" name="money"><br>
				<div class="a"><input type="submit" name="add_money" value="Начислить"></div><br>
				</div>
				<br>
			<div class="block">
			Выгрузка ресурсов<br>
				<div class="a"><input type="submit" name="del_mater" value="Выгрузить"></div><br>
				</div>
			<div class="block">
			Вывод денег<br>
				<div class="a"><input type="submit" name="del_money" value="Вывести"></div><br>
				</div>
				<br>
				<div class="a"><input type="submit" name="del" value="Закрыть фабрику"></div><br>
	';
    if ($type_num == 1) {
        echo '
                
                <div class="block">
                Загрузить сырья на склад фабрики<br>
				<input type="text" name="ore"><br>
				<div class="a"><input type="submit" name="add_ore" value="Начислить"></div><br>
				<br>
				</div>
		';
    }
    if ($type_num == 2) {
        echo ' 
                <div class="block">
                Загрузить второго сырья на склад фабрики<br>
				<input type="text" name="ore2"><br>
				<div class="a"><input type="submit" name="add_ore2" value="Начислить"></div><br>
				<br>
				</div>
		';
    }
    echo '</form>';
}
//Код редактирования
if (isset($_POST['edit_name'])) {
    $name = $_POST['name'];
    $name = htmlentities($name);
    $query = $conn->prepare('UPDATE `factory` SET `name` = :name WHERE `id` = :id');
    $query->bindValue(":name", $name);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Имя сменено<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['edit_salary'])) {
    if ($_POST['salary'] < 0) {
        die('Зарплата не может быть меньше нуля');
    }
    $salary = $_POST['salary'];
    $salary = htmlentities($salary);
    $query = $conn->prepare('UPDATE factory SET salary = :salary WHERE id = :id');
    $query->bindValue(":salary", $salary);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Зарплата изменена<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['edit_res'])) {
    if ($_POST['res'] < 0 && $_POST['res'] > 100) {
        die('Процент выдаваемых ресурсов не может быть меньше нуля или больше ста');
    }
    $res = $_POST['res'];
    $res = htmlentities($res);
    $query = $conn->prepare('UPDATE factory SET res = :res WHERE id = :id');
    $query->bindValue(":res", $res);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Процент изменён<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['add_money'])) {
    $money = $_POST['money'];
    $money = htmlentities($money);
    if ($money > $user['money']) {
        die('Недостаточно средств');
    }
    if ($money < 0) {
        die('Недостаточно средств');
    }
    $query = $conn->prepare('UPDATE `users` SET `money` = `money` - :money WHERE `id` = :id');
    $query->bindValue(":money", $money);
    $query->bindValue(":id", $user['id']);
    $query->execute();
    $query = $conn->prepare('UPDATE `factory` SET `money` = `money` + :money WHERE `id` = :id');
    $query->bindValue(":money", $money);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Счёт изменён<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['del_mater'])) {
    $store = $factory['store'];
    $type = $factory['type'];
    if ($store == 0) {
        die('Склад пуст');
    }
    if ($type == 'metal') {
        $conn->query("UPDATE `store` SET `metal` = `metal` + '" . $store . "' WHERE `id` = '" . $user['id'] . "'");
        $query = $conn->prepare('UPDATE `factory` SET `store` = `store` - :store WHERE `id` = :id');
        $query->bindValue(":store", $factory['store']);
        $query->bindValue(":id", $factory['id']);
        $query->execute();
        echo 'Счёт изменён<br>';
        echo 'Перезагрузка через секунду';
        die('<meta http-equiv="Refresh" content="1" />');
    }
}
if (isset($_POST['del_money'])) {
    $query = $conn->prepare('UPDATE `users` SET `money` = `money` + :money WHERE `id` = :id');
    $query->bindValue(":money", $factory['money']);
    $query->bindValue(":id", $user['id']);
    $query->execute();
    $query = $conn->prepare('UPDATE `factory` SET `money` = `money` - :money WHERE `id` = :id');
    $query->bindValue(":money", $factory['money']);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Счёт выведен<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['add_ore'])) {
    $ore = $_POST['ore'];
    $ore = htmlentities($ore);
    if ($ore > $store_ore) {
        die('Недостаточно материалов');
    }
    if ($ore < 0) {
        die('Недостаточно материалов');
    }
    $query = $conn->prepare('UPDATE `store` SET `' . $type_ore . '` = `' . $type_ore . '` - :ore WHERE `id` = :id');
    $query->bindValue(":ore", $ore);
    $query->bindValue(":id", $user['id']);
    $query->execute();
    $query = $conn->prepare('UPDATE `factory` SET `ore` = `ore` + :ore WHERE `id` = :id');
    $query->bindValue(":ore", $ore);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Товар загружен<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['add_ore2'])) {
    $ore2 = $_POST['ore2'];
    $ore2 = htmlentities($ore2);
    if ($ore2 > $store_ore2) {
        die('Недостаточно материалов');
    }
    if ($ore2 < 0) {
        die('Недостаточно материалов');
    }
    $query = $conn->prepare('UPDATE `store` SET `' . $type_ore2 . '` = `' . $type_ore2 . '` - :ore WHERE `id` = :id');
    $query->bindValue(":ore2", $ore2);
    $query->bindValue(":id", $user['id']);
    $query->execute();
    $query = $conn->prepare('UPDATE `factory` SET `ore` = `ore` + :ore WHERE `id` = :id');
    $query->bindValue(":ore2", $ore2);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Товар загружен<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
echo '</div>';
echo '<div class="a"><a href="factory_viever.php">Назад</a></div>';
?>