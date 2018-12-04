<?php
include('../system/func.php');
auth();
banned($user);
// Нужна оптимизация
$id = _string(_num($_GET['id'])); //собачье дерьмо
$article = $conn->query("SELECT * FROM articles WHERE id = $id LIMIT 1")->fetch();

if ($article['id'] == '')
    die('<div class="block-up">Статья не найдена</div><div class="a-down"><a href="index.php">Назад</a></div>');

$comments = $conn->query("SELECT * FROM comment WHERE article_id = $id")->fetchAll();
if (($con_num = count($comments)) === 0) {
    echo "<div class='block-up'>Нет комментариев</div>";
} else {
    echo '<div class="block-up">';
    foreach ($comments as $comment) {
        $autist = $conn->query("SELECT * FROM users WHERE id = $comment[author_id]")->fetch();
        $name = name($autist);
        $text = text\smile::tosmile($comment['text']);
        echo "<div class='block-info'>$name<br>$text";
        if ($user['priv'] > 0) {
            echo '<a href=/delete/delete_comment.php?id=' . $comment[id] . '>[x]</a>';
        }
        echo '</div>';
    }
    echo '</div>';
}
echo "<div class='a-middle'><a href=send_comment.php?id=$id>Написать комментарий</a></div>";
echo "<div class='a-down'><a href=view_article.php?id=$id>Назад</a></div>";
?>
