<?php
include '../system/func.php';
auth();
banned($user);
echo '<div class="a-up"><a href="/game.php">На главную</a></div>';
echo '<div class="block-down"><div class="block-info">';
$mail_count = $conn->query("SELECT DISTINCT `from`, COUNT(*) FROM mail WHERE `to` = " . $user['id'])->fetch()['COUNT(*)'];
$i = 0;
while ($i < $mail_count) {
    $mail_user_from = $conn->query("SELECT DISTINCT `from` FROM mail WHERE `to` = " . $user['id'] . " LIMIT " . $i . ",1 ")->fetch();
    $user_sql = $conn->query("SELECT * FROM users WHERE id = " . $mail_user_from['from'])->fetch();
    echo '<div class="block-up">' . name($user_sql) . '<br>' . '</div><div class="a-down"><a href="mail.php?id=' . $mail_user_from['from'] . '">Открыть</a></div><br>';
    $i++;
}
echo '</div></div>';
echo '<div class="a"><a href="/game.php">На главную</a></div>';
