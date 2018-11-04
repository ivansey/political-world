<?php
include('../system/func.php');
auth();
banned($user);
//$noheader;

$query = $conn->prepare('INSERT INTO `comment` SET `article_id` = :article_id, `text` = :text, `author_id` = :author_id');
$query->bindValue(":article_id", htmlentities($_POST['id']));
$query->bindValue(":author_id", $user[id]);
$query->bindValue(":text", htmlentities($_POST['text']));
$query->execute();
die("<div class='block'>Комментарий успешно создан<div class='a'> <a href=view_comments.php?id=$_POST[id]>В комментарии</a></div></div>");

?>
