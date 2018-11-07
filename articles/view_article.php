<?php
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
$article = $conn->query("SELECT * FROM `articles` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();
$author = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $article[author_id] . "' LIMIT 1")->fetch();

if ($article[id] == '') {
    die('<div class="block">Статья не найдена<div class="a"><a href="index.php">Назад</a></div></div> ');
}
$name = name($author);
echo "<div class='block'><hr>$article[title]<br><small>$name</small><br><small>$article[time]</small><hr></div><br>";
echo "<div class='block'>$article[text]<div class='a'><a href=view_comments.php?id=$id>Показать комментарии</a></div></div><br>";
if ($user['priv'] > 0) {
echo '<div class="a"><a href=/delete/delete_article.php?id='.$id.'>Удалить(мод.)</a></div>';
}
echo "<div class='a'><a href=index.php>К списку</a></div>";

?>
