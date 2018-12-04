<?php
include('../system/func.php');
auth();
banned($user);

$a = _string(_num($_GET['id']));
$t = $conn->query("SELECT * FROM company WHERE leader = $user[id] AND id = $a")->fetch();
if (isset($_POST['edit_name'])) {
    $name = $_POST['name'];
    $name = htmlentities($name);
    $query = $conn->prepare('UPDATE `company` SET `name` = :name WHERE `id` = :id');
    $query->bindValue(":name", $name);
    $query->bindValue(":id", $t[id]);
    $query->execute();
    echo 'Название сменено<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['add_money'])) {
    $money = $_POST['money'];
    $money = htmlentities($money);
    if ($money > $user['money']) {
        die('<div class="block">Недостаточно средств</div>');
    }
    if ($money < 0) {
        die('<div class="block">Недостаточно средств</div>');
    }
    $query = $conn->prepare('UPDATE `users` SET `money` = `money` - :money WHERE `id` = :id');
    $query->bindValue(":money", $money);
    $query->bindValue(":id", $user[id]);
    $query->execute();
    $query = $conn->prepare('UPDATE `company` SET `budget` = `budget` + :money WHERE `id` = :id');
    $query->bindValue(":money", $money);
    $query->bindValue(":id", $t['id']);
    $query->execute();
    echo 'Счёт изменён<br>';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if($t[name] == '') {
echo '<div class="block">Ошибка</div>';
}  else {
$count = $conn->query("SELECT COUNT(*) FROM company_members WHERE cid = $a")->fetchColumn();

echo "<div class='block'>Компания &#171;$t[name]&#187;</div><br>";
echo "<div class='block'>Фабрик в составе: $count<br><br>Бюджет: $t[budget]</div>";
echo "<div class='a'><a href=?id=$a&change_name>Изменить название</a></div>";
if(isset($_GET['change_name'])) {
echo '<br><div class="block"><form action="" method="post">
			Новое название<br>
				<input type="text" name="name"><br>
				<input type="submit" name="edit_name" value="Изменить"></form></div><br>';
}
echo "<div class='a'><a href=?id=$a&budget>Пополнить бюджет</a></div>";
if(isset($_GET['budget'])) {
echo '<br><div class="block"><form action="" method="post">
			Сумма<br>
				<input type="number" name="money"><br>
				<input type="submit" name="add_money" value="Изменить"></form></div><br>';
}
echo "<div class='a'><a href=contracts.php?id=$a>Управление контрактами</a></div>";
echo "<br><div class='a'><a href=company.php?id=$a>Назад</a></div>";
}

?>
