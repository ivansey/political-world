<?php
include('../system/func.php');
auth();
moder_auth($user);
banned($user);

$id = _string(_num($_GET['id']));

$conn->query("DELETE FROM `comment` WHERE `id` = ".$id." ");
log_admin($user, 'Удалил комментарий ' . $id);
echo '<div class="block">Успешно</div>';
?>
