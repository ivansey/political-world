<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 24.11.18
 * Time: 18:26
 */
$noheader = 1;
include '../system/func.php';

$id = _num(_string($_GET['id']));
$mail_count = $conn->query("SELECT COUNT(*) FROM mail WHERE (`to` = 2 AND `from` = 1) or (`to` = 1 AND `from` = 2)")->fetch()['COUNT(*)'];
$i = 0;
echo '<div class="chat">';
while ($i < $mail_count) {
    $mail_user = $conn->query("SELECT * FROM mail WHERE (`to` = " . $user['id'] . " AND `from` = " . $id . ") or (`to` = " . $id . " AND `from` = " . $user['id'] . ") LIMIT " . $i .",1")->fetch();
    $user_sql = $conn->query("SELECT * FROM users WHERE id = " . $mail_user['from'])->fetch();
    //$text = iconv('windows-1251', 'UTF-8', $mail_user['text']);
    $text = text\bbcode::tohtml($mail_user['text'], true);
    $text = text\smile::tosmile($text);
    echo name($user_sql) . '(' . ')<br>' . $mail_user['text'] . '<br><br>';
    $i++;
}
echo '</div>';
echo '<meta http-equiv="Refresh" content="10">';
echo '<a name="down"></a>';