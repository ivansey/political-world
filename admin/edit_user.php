<?php
include('../system/func.php');
//include '../system/class/bbcode.php';
auth();
banned($user);
admin_auth($user);
$id = _string(_num($_GET['id']));
$userr = $conn->query("SELECT * FROM users WHERE id = $id")->fetch();

if($user[priv] <= $userr[priv]) {
die('<div class="block">Нельзя!</div>');
}
if(isset($_GET['edit_user'])){
$name = $_POST['name'];
$about = $_POST['about'];
$tag = $_POST['tag'];
$money = $_POST['money'];
$gold = $_POST['gold'];
$energy = $_POST['energy'];
$lvl = $_POST['lvl'];
$exp = $_POST['exp'];
$party = $_POST['party'];
$region = $_POST['region'];
$gover = $_POST['gover'];
echo $name . 'раз';
if($user[priv] >= 3) {
$priv = $_POST['priv'];
$queryy = $conn->query("UPDATE users SET name = '$name', about = '$about', tag = '$tag', money = $money, gold = $gold, energy = $energy, lvl = $lvl, exp = $exp, party = $party, region = $region, gover = $gover, priv = $priv WHERE id = $userr");
} else {
$queryy = $conn->query("UPDATE users SET name = '$name', about = '$about', tag = '$tag', money = $money, gold = $gold, energy = $energy, lvl = $lvl, exp = $exp, party = $party, region = $region, gover = $gover WHERE id = $userr");
}
}
switch($user[priv]) {
case 2:
echo '<div class="block">Админ редактор</div><br><div class="block">';
echo "<form method='post' action='?edit_user'>";
echo "Логин:<br><input type='text' name='name' value='$userr[name]'><br>";
echo "О себе:<br><input type='text' name='about' value='$userr[about]'><br>";
echo "Тег:<br><input type='text' name='tag' value='$userr[tag]'><br>";
echo "Денег:<br><input type='text' name='money' value='$userr[money]'><br>";
echo "Голды:<br><input type='text' name='gold' value='$userr[gold]'><br>";
echo "Энергии:<br><input type='text' name='energy' value='$userr[energy]'><br>";
echo "Лвл:<br><input type='text' name='lvl' value='$userr[lvl]'><br>";
echo "Опыта:<br><input type='text' name='exp' value='$userr[exp]'><br>";
echo "Партия:<br><input type='text' name='party' value='$userr[party]'><br>";
echo "Регион:<br><input type='text' name='region' value='$userr[region]'><br>";
echo "Где руководит:<br><input type='text' name='gover' value='$userr[gover]'><br>";
echo "<input type='submit' value='Изменить'>";
echo "</form>";
echo "</div>";
break;
case 3:
echo '<div class="block">Суперадмин редактор</div><br><div class="block">';
echo "<form method='post' action='?edit_user=$id'>";
echo "Логин:<br><input type='text' name='login' value='$userr[name]'><br>";
echo "О себе:<br><input type='text' name='about' value='$userr[about]'><br>";
echo "Тег:<br><input type='text' name='tag' value='$userr[tag]'><br>";
echo "Денег:<br><input type='text' name='money' value='$userr[money]'><br>";
echo "Голды:<br><input type='text' name='gold' value='$userr[gold]'><br>";
echo "Энергии:<br><input type='text' name='energy' value='$userr[energy]'><br>";
echo "Лвл:<br><input type='text' name='lvl' value='$userr[lvl]'><br>";
echo "Опыта:<br><input type='text' name='exp' value='$userr[exp]'><br>";
echo "Партия:<br><input type='text' name='party' value='$userr[party]'><br>";
echo "Регион:<br><input type='text' name='region' value='$userr[region]'><br>";
echo "Где руководит:<br><input type='text' name='gover' value='$userr[gover]'><br>";
echo "Привилегия:<br><input type='text' name='priv' value='$userr[priv]'><br>";
echo "<input type='submit' value='Изменить'>";
echo "</form>";
echo "</div>";
break;
default:
echo '<div class="block">Ошибка</div>';
break;
}
