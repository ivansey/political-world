<?php
include('../system/func.php');
auth();
banned($user);
// Last change 16:29 1 noyabrya by coding maestro
$type = _string(_num($_GET['type']));

if(!isset($type) or $type > 2) {
$type = 0;
}

if($user[api_token] == '0') {
$id = $user[id];
$token = bin2hex(openssl_random_pseudo_bytes(16));
$conn->query("UPDATE `users` SET `api_token` = '" . $token . "' WHERE `id` = '" . $id . "'");
}

switch($type) {
case 0:
echo '<div class="block"><div class="a"><a href="?type=1">Токен</a></br></div><div class="a"><a href=?type=2>Дизайн</a></div></div><div class="a-down"><a href="../users/index.php">Назад в профиль</a></div>';
break;
case 1:
echo '<div class="block">Ваш токен: '.$user[api_token]. '</div><div class="a-down"><a href="index.php">Назад</a></div>';
break;
case 2:
echo '<div class="block"><div class="block-info">Выбрать стиль:<br><form method="post" action="change_style.php"><select name="taskOption">';
$styles = $conn->query("SELECT * FROM `styles`");
while($style=$styles->fetch()){
echo "<div class='block'> <option value=$style[id]>$style[name]</option>";
}
echo '</select></div><div class="a-down"><input type="submit" value="Изменить"/></div></div></div> </form><div class="a-down"><a href="index.php">Назад</a></div>';
break;
}

?>
