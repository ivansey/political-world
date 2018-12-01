<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 25.11.18
 * Time: 19:02
 */
include '../system/func.php';

$id = _num(_string($_GET['id']));

$parliament_sql = $conn->query("SELECT COUNT(*) FROM `parlament` WHERE `gover` = " . $id)->fetch()['COUNT(*)'];
$parliament = $conn->query("SELECT * FROM `parlament` WHERE `gover` = " . $id)->fetch();
$gover = $conn->query("SELECT * FROM `goverment` WHERE `id` = " . $id)->fetch();

if ($parliament_sql == 0) {
    echo '<div class="block">Парламента не существует<div class="a-down"><a href="../game.php">На главную</a> </div> </div>';
    exit;
}

echo '
<div class="block">
<form action="handler.php" method="post">
Создание парламента<br>
<input type="hidden" name="gover_id" value="' . $id . '">
<select size="3" name="type">
<option disabled>Изменение данных государства</option>
<option value="change_name">Изменение названия государства</option>
<option value="change_priv_leader">Изменение привелегий для лидера государства</option>
</select>
<input type="submit" name="submit" value="Издать">
</form>
</div>
<div class="a-down"><a href="index.php?id=' . $id . '">На главную</a> </div>
';