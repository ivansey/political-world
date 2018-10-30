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
	    <input type="submit" name="create" value="Создать склад">
	</form>
    ';
    if(isset($_POST['create'])) {
	$conn->query("INSERT INTO store SET id = '" . $id_user . "'");
	echo '
	    Склад создан
	    <a href="store.php">Открыть склад</a>
	    <a href="../game.php">В главное меню</a>
	';
    }
}else{
    //Вывод ресурсов
    $resourse = $conn->query("SELECT * FROM store WHERE id = '" . $id_user . "'")->fetch();
    echo '
	Железо: ' . $resourse['metal'] . ' <br>' . '
	Железная руда: ' . $resourse['metal_ore'] . ' <br>' . '
	Олово: ' . $resourse['tin'] . ' <br>' . '
	Оловяная руда: ' . $resourse['tin_ore'] . ' <br>' . '
	Сталь: ' . $resourse['steel'] . ' <br>' . '
	Нефть: ' . $resourse['oil'] . ' <br>' . '
	Топливо: ' . $resourse['fuel'] . ' <br>' . '
	Еда: ' . $resourse['food'] . ' <br>' . '
	<a href="../game.php">В главное меню</a>';
}
?>
