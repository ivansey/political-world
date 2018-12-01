<?php
include('../system/func.php');
//include '../system/class/bbcode.php';
auth();
banned($user);
$id = _string(_num($_GET['id']));
$article = $conn->query("SELECT * FROM `articles` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();
$author = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $article[author_id] . "' LIMIT 1")->fetch();

if ($article[id] == '') {
    die('<div class="block">Статья не найдена<div class="a"><a href="index.php">Назад</a></div></div> ');
}
$name = name($author);
$text = text\smile::tosmile($article['text']);
$text = text\BBcode::tohtml($text, 1);

echo "<div class='block'><hr>$article[title]<br><small>$name</small><br><small>$article[time]</small><hr></div><br>";
echo "<div class='block'>$text<div class='a'><a href=view_comments.php?id=$id>Показать комментарии</a></div></div><br>";
if ($user['priv'] > 0) {
echo '<div class="a"><a href=/delete/delete_article.php?id='.$id.'>Удалить(мод.)</a></div>';
}
echo "<div class='a'><a href=index.php>К списку</a></div>";

?>
