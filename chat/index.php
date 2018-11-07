<?php
include('../system/func.php');
auth();
banned($user);
banned_chat($user);
?>
<div class="block">
<iframe name="chat" id="chat" height="500" width="500" src="engine.php#down"></iframe><br>
<form action="" method="post" target="">
    <input type="text" name="message" size="50"><br>
    <div class="a"> <input type="submit" name="send_message" valve="Отправить"></div></div>
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
        header('Location: index.php'); exit;
    }
?>
</form>
<div class="a"><a href=../game.php>На главную</a></div>
<?php
//Проверка уровня админа и вывод кнопок
if($user['priv'] >= 1) {
    echo("<div class='a'><a href=../admin/chat.php>Управление чатом</a></div>");
}
?>
