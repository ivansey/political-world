<?php
include('../system/func.php');
auth();
su_auth($user);
banned($user);

$id = _string(_num($_GET['id']));

$conn->query("DELETE FROM `regions` WHERE `id` = ".$id." ");
$conn->query("UPDATE `users` SET `region` = 1 WHERE `region` = ".$id." ");
log_admin($user, 'Удалил регион ' . $id);
echo '<div class="block">Успешно</div>';
?>
