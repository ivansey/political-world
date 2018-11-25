<?php
include('../system/func.php');
auth();
banned($user);

echo '<br>';

$summ = $conn->query("SELECT COUNT(*) FROM `articles`")->fetch()['COUNT(*)'];
if ($summ == 0) {
    die('<div class="block">Нет статей</div>');
} else {
    $articles = $conn->query("SELECT * FROM `articles` ORDER BY `id` DESC");
    echo '<div class="block">';
    while ($article = $articles->fetch()) {
        echo '<div class="a"><a href=view_article.php?id=' . $article['id'] . '>' . $article['title'] . '</a><br><small>' . $article['name'] . '</small></div>';
    }
echo '</div>';
}
echo '<br><div class="a"><a href="create_article.php">Создать статью</a></div><div class="a"><a href="/">На главную</a></div>';

?>
