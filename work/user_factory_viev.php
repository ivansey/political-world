<?php
include('../system/func.php');
auth();
banned($user);

echo '<div class="block">';
//Переменные и вывод ошибок
$id_factory = $_GET['id_factory'];
$factory_sql = $conn->query("SELECT COUNT(*) FROM `factory` WHERE `leader` = $user[id]")->fetch()['COUNT(*)'];
if ($factory_sql == 0) {
    die('<div class="block">У вас нет фабрик</div>');
}
$factory = $conn->query("SELECT * FROM `factory` WHERE `id` = $id_factory AND `leader` = $user[id] ")->fetch();
if($factory[name] == "") {
        die('<div class="block">Ошибка</div>');
}
$user_store = $conn->query("SELECT * FROM `store` WHERE `id` = $user[id] ")->fetch();
$type = $factory['type'];
$ftype = $conn->query("SELECT * FROM `factory_types` WHERE `res` = $type ")->fetch();
$nnname = name($user);
//Формы
echo 'Название: ';
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
echo $nnname;
echo '<br>';
echo 'Остаток денежных средств: ' . $factory['budget_money'] . '<br>';
//Формы для переработчиков
echo 'Сырья на складе: ' . $factory['budget_res'] . '<br>';
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
        echo '
                
                <div class="block">
                Загрузить сырье на склад фабрики<br>
				<input type="text" name="ore"><br>
				<div class="a"><input type="submit" name="add_ore" value="Начислить"></div><br>
				<br>
				</div>
		';
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
    $query = $conn->prepare('UPDATE factory SET salary_money = :salary WHERE id = :id');
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
    $query = $conn->prepare('UPDATE factory SET salary_res = :res WHERE id = :id');
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
    $query = $conn->prepare('UPDATE `factory` SET `budget_money` = `budget_money` + :money WHERE `id` = :id');
    $query->bindValue(":money", $money);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Счёт изменён<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['del_mater'])) {
    $store = $factory['budget_res'];
    if ($store == 0) {
        die('Склад пуст');
    }
    //if ($type == 'metal') {
        $conn->query("UPDATE `store` SET `sum` = `sum` + $store WHERE `id` = $user[id] AND `type` = $type");
        $query = $conn->prepare('UPDATE `factory` SET `budget_res` = `budget_res` - :store WHERE `id` = :id');
        $query->bindValue(":store", $factory['budget_res']);
        $query->bindValue(":id", $factory['id']);
        $query->execute();
        echo 'Счёт изменён<br>';
        echo 'Перезагрузка через секунду';
        die('<meta http-equiv="Refresh" content="1" />');
    //}
}
if (isset($_POST['del_money'])) {
    $query = $conn->prepare('UPDATE `users` SET `money` = `money` + :money WHERE `id` = :id');
    $query->bindValue(":money", $factory['budget_money']);
    $query->bindValue(":id", $user['id']);
    $query->execute();
    $query = $conn->prepare('UPDATE `factory` SET `budget_money` = `budget_money` - :money WHERE `id` = :id');
    $query->bindValue(":money", $factory['budget_money']);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Счёт выведен<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['add_ore'])) {
    $ore = $_POST['ore'];
    $ore = htmlentities($ore);
    $store_maat = $conn->query("SELECT * FROM `store` WHERE `id` = $user[id] AND `type` = $type")->fetch();
    if ($ore > $store_maat[sum]) {
        die('Недостаточно материалов');
    }
    if ($ore < 0) {
        die('Недостаточно материалов');
    }
    $query = $conn->prepare("UPDATE `store` SET `sum` = `sum` - :ore WHERE `id` = :user AND `type` = :type");
    $query->bindValue(":ore", $ore);
    $query->bindValue(":user", $user[id]);
    $query->bindValue(":type", $type);
    $query->execute();
    $query = $conn->prepare('UPDATE `factory` SET `budget_res` = `budget_res` + :ore WHERE `id` = :id');
    $query->bindValue(":ore", $ore);
    $query->bindValue(":id", $factory['id']);
    $query->execute();
    echo 'Товар загружен<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['del'])) {
    $factory_del = $conn->query("SELECT * FROM `factory` WHERE `id` = " . $id_factory)->fetch();
    $conn->query("UPDATE `users` SET `money` = `money` + " . $factory_del['budget_money'] . " WHERE `id` = " . $user['id']);
    $conn->query("UPDATE `store` SET `sum` = `sum` + " . $factory_del['budget_res'] . " WHERE `id` = $user[id] AND `type` = $type");
    $conn->query("UPDATE `users` SET `work` = 0 WHERE `work` = $factory_del[id] ");
    $conn->query("DELETE FROM `factory` WHERE `id` = " . $id_factory);
    echo '<div class="block">Фабрика удалена</div>';
}
echo '</div>';
echo '<div class="a"><a href="factory_viever.php">Назад</a></div>';
?>
