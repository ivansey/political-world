<?php
include('../system/func.php');
auth();
banned($user);
$id = $user['id'];
$name = $_POST['name'];
$name = htmlentities($name);
$gold = 50;
if (empty($name)) {
    die("<div class='block-up'>Не введено имя</div><div class='a-down'><a href=edit.php>Вернуться</a></div>");
} else {
    $val = $conn->query("SELECT COUNT(*) FROM `users` WHERE `name` = '" . $name . "'")->fetch()['COUNT(*)'];
    if ($val > 0) {
        die("<div class='block-up'>Введённое имя занято</div><div class='a-down'> <a href=edit.php>Вернуться</a></div>");
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
            echo("<div class='block-up'>Имя сменено на '$name' </div><div class='a-down'> <a href=edit.php>Вернуться</a></div>");
        } else {
            echo '<div class="block-up">Не хватет золота(требуется 50) </div><div class="a-down"> <a href=edit.php>Вернуться</a></div>';
        }
    }
}

