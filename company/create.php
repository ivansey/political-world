<?php
include('../system/func.php');
auth();
banned($user);

//Формы
echo '
    <div class="block">
	<form action="chandler.php" method="post">
		Название:<br>
		<input type="text" name="name"><br>
	   Тип организации<br><select name="taskOption">';
$types = $conn->query("SELECT * FROM company_type");
while($type=$types->fetch()){
echo "<div class='block'> <option value=$type[id]>$type[name]</option>";
}
    echo '</select><br>
		<input type="submit" name="create" value="Создать(1000 SCR)"><br>
	</form>
';

echo '</div>';
echo '<div class="a-middle"><a href="index.php">Назад</a></div>';
?>
