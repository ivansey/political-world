<?php
include('../system/func.php');
auth();
banned($user);
moder_auth($user);

$sum = $conn->query("SELECT COUNT(*) FROM `users`")->fetch();
$i = 0;
while ($i <= $sum) {
	$i++;
	$sql = $conn->query("SELECT * FROM `users` LIMIT '" . $i . "','" . $i ."'");
	$msg = "id: " . $sql['id'] . ", name: " . $sql['name'] . ", email: " . $sql['mail'];
	$profile = '<a href="profile.php?id=' . $sql['id'] . '">Открыть профиль</a>';
	echo ($msg . $profile);
}
?>
