<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 23.11.18
 * Time: 20:47
 */
include "../system/func.php";
auth();
banned($user);
echo '<div class="a-up"><a href="index.php">Назад</a></div>';
echo '<div class="a-middle"><a href="../game.php">На главную</a></div>';
$id = _num(_string($_GET['id']));
echo '<div class="block-middle"><div class="block-info-up">';
$i = 0;
echo '<iframe width="240" height="600" src="engine.php?id=' . $id . '#down"></iframe>';
echo '
</div>
<div class="block-info-down">
<form action="" method="post">
<input type="text" name="text">
<input type="submit" name="send" value="Отправить">
</form>
</div>
</div>
';
if (isset($_POST['send'])) {
    $text = htmlentities($_POST['text']);
    $query = $conn->prepare("INSERT INTO mail SET `to` = :to, `from` = :from, `text` = :text, `time` = :time, `read` = :read");
    $query->bindValue(":to", $id);
    $query->bindValue(":from", $user['id']);
    $query->bindValue(":text", $text);
    $query->bindValue(":time", date('Y-m-d H:i:s'));
    $query->bindValue(":read", 0);
    $query->execute();
// Notify start
$usss = $conn->query("SELECT * FROM users WHERE id = $id")->fetch();
$timee = date("H:i:s");
notification("Новое сообщение!", $timee, "http://v92707.hosted-by-vdsina.ru/mail/mail.php?id=$user[id]", $usss);
// Notify end
    header ("Location: mail.php?id=" . $id);
}
echo '<div class="block-middle"><iframe width="200" srcdoc="';
text\smile::smile_look();
echo '"></iframe></div></div>';
echo '<div class="a-middle"><a href="index.php">Назад</a></div>';
echo '<div class="a-down"><a href="../game.php">На главную</a></div>';
