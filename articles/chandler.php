<?php
include('../system/func.php');
auth();
banned($user);

$query = $conn->prepare('INSERT INTO `comment` SET `article_id` = :article_id, `text` = :text, `author_id` = :author_id');
$query->bindValue(":article_id", htmlentities($_POST['id']));
$query->bindValue(":author_id", $user[id]);
$query->bindValue(":text", htmlentities($_POST['text']));
$query->execute();
// Notify start
$ai = $_POST['id'];
$auth = $conn->query("SELECT * FROM articles WHERE id = $ai")->fetch();
if($auth[author_id] != $user[id]) {
$aaa = $conn->query("SELECT * FROM users WHERE id = $auth[author_id]")->fetch();
$timee = date("H:i:s");
notification("Новый комментарий к вашей статье!", $timee, "articles/view_comments.php?id=$ai", $aaa);
}
// Notify end
die("<div class='block'>Комментарий успешно создан<div class='a'> <a href=view_comments.php?id=$_POST[id]>В комментарии</a></div></div>");

?>
