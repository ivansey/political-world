<?php
include('../system/func.php');
auth();
banned($user);

$work = $user['work'];
//Формы
echo '
    <div class="block">
	<form action="chandler.php" method="post">
		Название:<br>
		<input type="text" name="name"><br>
	   Тип фабрики<br><select name="taskOption">';
$types = $conn->query("SELECT * FROM `factory_types`");
while($type=$types->fetch()){
echo "<div class='block'> <option value=$type[res]>$type[name]($type[cost] RUB)</option>";
}
    echo '</select><br>
		Выдаваемая зарплата<br>
		<input type="number" name="salary"><br>
		Выдаваемый процент ресурсов<br>
		<input type="number" name="res"><br><br>
		<div class="a"><input type="submit" name="create" value="Создать"></div><br>
	</form>
';
//Код создания фабрики

echo '</div>';
echo '<div class="a"><a href="index.php">На работу</a></div>';
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
