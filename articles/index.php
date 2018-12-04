<?php
include('../system/func.php');
auth();
banned($user);

echo '<br>';

$summ = $conn->query("SELECT COUNT(*) FROM `articles` limit 0,50")->fetch()['COUNT(*)'];
if ($summ == 0) {
    die('<div class="block-up">Нет статей</div>');
} else {
    $articles = $conn->query("SELECT * FROM `articles` ORDER BY `id` DESC limit 0,50");
    echo '<div class="block-up">';
    while ($article = $articles->fetch()) {
        echo '<div class="a"><a href=view_article.php?id=' . $article['id'] . '>' . $article['title'] . '</a><br><small>' . $article['name'] . '</small></div>';
    }
echo '</div>';
}
echo '<div class="a-middle"><a href="create_article.php">Создать статью</a></div><div class="a-down"><a href="/">На главную</a></div>';
