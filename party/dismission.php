<?php
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
// нахуй сука блятт

$party = $conn->query("SELECT * FROM `party` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();
$leader = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $party[leader] . "' LIMIT 1")->fetch();

if($leader[id] == $user[id]) {
// Notify start
$uss = $conn->query("SELECT * FROM users WHERE party = $party[id]");
while($user=$uss->fetch()){
$timee = date("H:i:s");
notification("Ваша партия была распущена", $timee, "", $user);
}
// Notify end
$conn->query("DELETE FROM `party` WHERE `id` = ".$id." ");
$conn->query("UPDATE `users` SET `party` = 0, `tag` = '' WHERE `party` = ".$id." ");
echo '<div class="block">Успешно</div>';
} else {
echo '<div class="block">Ошибка</div>';
}
echo '<div class="a"><a href=index.php>К списку</a></div>';
?>
