<?php
include('system/func.php');
auth();
banned($user);
banned_chat($user);
?>
<iframe name="chat" id="chat" height="500" width="500" src="chat_engine.php#down"></iframe><br>
<form action="" method="post" target="">
    <input type="text" name="message" size="50"><br>
    <input type="submit" name="send_message" valve="Отправить">
    <?php
    $name = name($user);
    $message = $_POST['message'];
    $date = date('H:i:s');
    $message = htmlentities($message);
    if ($_POST['send_message']) {
        $query = $conn->prepare('INSERT INTO `chat` SET `text` = :message, `name` = :name, `time` = :date');
	$query->bindValue(":message", $message); 
	$query->bindValue(":name", $name); 
	$query->bindValue(":date", $date);
	$query->execute();
        header('Location: chat.php'); exit;
    }
?>
</form>
<a href=game.php>На главную</a>
<?php
//Проверка уровня админа и вывод кнопок
if($user['priv'] >= 1) {
    echo("<br><a href=/admin/chat.php>Управление чатом</a>");
}
?>
