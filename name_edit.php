<?php
include('system/func.php');
auth();
banned($user);
$id = $user['id'];
$name = $_POST['name'];
$name = htmlentities($name);
$gold = 50;
if (empty($name)) {
    die("Не введено имя <br> <a href=profile_edit.php>Вернуться</a>");
} else {
    $val = $conn->query("SELECT COUNT(*) FROM `users` WHERE `name` = '" . $name . "'")->fetch()['COUNT(*)'];
    if ($val > 0) {
        die("Введённое имя занято <br> <a href=profile_edit.php>Вернуться</a>");
    } else {
        if ($user['gold'] >= 50) {
	    //Защищённый запрос
	    $query = $conn->prepare('UPDATE `users` SET `gold` = `gold` - :gold WHERE `id` = :id');
	    $query->bindValue(":gold", $gold);
	    $query->bindValue(":id", $id);
	    $query->execute();
            $query = $conn->prepare('UPDATE `users` SET `name` = :name WHERE `id` = :id');
	    $query->bindValue(":name", $name);
	    $query->bindValue(":id", $id);
	    $query->execute();
            echo("Имя сменено на '$name'. <br> <a href=profile_edit.php>Вернуться</a>");
        } else {
            echo 'Не хватет золота(требуется 50) <br> <a href=profile_edit.php>Вернуться</a>';
        }
    }
}

