<?php
include('../system/func.php');
auth();
banned($user);
//$noheader;
$date = date('Y-m-d H:i:s');

$query = $conn->prepare('INSERT INTO `articles` SET `title` = :title, `text` = :text, `author_id` = :author_id, `time` = :time');
$query->bindValue(":title", htmlentities($_POST['title']));
$query->bindValue(":text", htmlentities($_POST['content']));
$query->bindValue(":author_id", $user['id']);
$query->bindValue(":time", $date);
$query->execute();
die("<div class='block'>Статья успешно создана<div class='a'> <a href=index.php>В список</a></div></div>");

?>
