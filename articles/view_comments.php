<?php
include('../system/func.php');
auth();
banned($user);
// Нужна оптимизация
$id = _string(_num($_GET['id'])); //собачье дерьмо
$article = $conn->query("SELECT * FROM articles WHERE id = $id LIMIT 1")->fetch();

if ($article['id'] == '')
    die('<div class="block">Статья не найдена<div class="a"><a href="index.php">Назад</a></div></div> ');

$comments = $conn->query("SELECT * FROM comment WHERE article_id = $id")->fetchAll();
if (($con_num = count($comments)) === 0) {
    echo "<div class='block'>Нет комментариев</div>";
} else {
    foreach ($comments as $comment) {
        $autist = $conn->query("SELECT * FROM users WHERE id = $comment[author_id]")->fetch();
$name = name($autist);
        echo "<div class='block'>$name<hr>$comment[text]";
if ($user['priv'] > 0) {
echo '<a href=/delete/delete_comment.php?id='.$comment[id].'>[x]</a>';
}
echo '</div>';
    }
}
echo "<div class='a'><a href=send_comment.php?id=$id>Написать комментарий</a></div>";
echo "<hr><div class='a'><a href=view_article.php?id=$id>Назад</a></div>";
?>
