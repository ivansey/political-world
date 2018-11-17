<?php
include('../system/func.php');
auth();
admin_auth($user);
banned($user);

$id = _string(_num($_GET['id']));

$conn->query("DELETE FROM `party` WHERE `id` = ".$id." ");
$conn->query("UPDATE `users` SET `party` = 0, `tag` = '' WHERE `party` = ' " . $id . " ' ");
log_admin($user, 'Удалена  партия: ' . $id);
echo '<div class="block">Успешно</div>';
?>
