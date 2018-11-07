<?php
include('../system/func.php');
auth();
moder_auth($user);
banned($user);

$id = _string(_num($_GET['id']));

$conn->query("DELETE FROM `articles` WHERE `id` = ".$id." ");
$conn->query("DELETE FROM `comment` WHERE `article_id` = ".$id." ");
echo '<div class="block">Успешно</div>';
?>
