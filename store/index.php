<?php
include('system/func.php');
auth();
banned($user);
$id_user = $user['id'];
$sql = $conn->query("SELECT COUNT(*) FROM store WHERE id = '" . $id_user . "'")->fetch()['COUNT(*)'];

//Проверка наличия склада и создание оного
if($sql == 0) {
    echo '
	<form action="" method="post">
	    <div class="a"><input type="submit" name="create" value="Создать склад"></div>
	</form>
    ';
    if(isset($_POST['create'])) {
	$conn->query("INSERT INTO store SET id = '" . $id_user . "'");
	echo '
	    Склад создан
	    <div class="a"><a href="index.php">Открыть склад</a></div>
	    <div class="a"><a href="../game.php">В главное меню</a></div>
	';
    }
}else{
    //Вывод ресурсов
    $resourse = $conn->query("SELECT * FROM store WHERE id = '" . $id_user . "'")->fetch();
    echo '
    <div class="block">
	Железо: ' . $resourse['metal'] . ' <br>' . '
	Железная руда: ' . $resourse['metal_ore'] . ' <br>' . '
	Олово: ' . $resourse['tin'] . ' <br>' . '
	Оловяная руда: ' . $resourse['tin_ore'] . ' <br>' . '
	Сталь: ' . $resourse['steel'] . ' <br>' . '
	Нефть: ' . $resourse['oil'] . ' <br>' . '
	Топливо: ' . $resourse['fuel'] . ' <br>' . '
	Еда: ' . $resourse['food'] . ' <br>' . '
	</div>
	<div class="a"><a href="../game.php">В главное меню</a></div>';
}
?>
