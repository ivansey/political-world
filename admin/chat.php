<?php
include('../system/func.php');
auth();
moder_auth($user);
banned($user);
//Считаем кол-во сообщений
$sum = $conn->query("SELECT COUNT(*) INTO `chat`")->fetch()['COUNT(*)'];
echo '
Настройки чата<br>
Кол-во сообщений: 
';
echo($sum);
//Формы
echo '
<br>
<form action="" method="post">
<input type="submit" name="delete_all" value="Удалить все сообщения"><br>
Удалить сообщение:<br>
<input type="text" name="dlt_msg"><br>
<input type="submit" name="delete_msg" value="Удалить"><br>
------<br>
id<br>
<input type="text" name="id_user"><br>
Удаление всех сообщений автора<br>
<input type="submit" name="delete_author"><br>
Общий бан<br>
Причина<br>
<input type="text" name="ban_about"><br>
Время ГГГГ-ММ-ДД ЧЧ:ММ:СС<br>
<?php echo($datetime); ?>
<input type="text" name="ban_time"><br>
Бан чата<br>
<input type="submit" name="ban_chat"><br>
Бан<br>
<input type="submit" name="ban"><br>
</form>
';
$dlt_msg = $_POST['dlt_msg'];
$id_user = $_POST['id_user'];
$ban_about = $_POST['ban_about'];
$ban_time = $_POST['ban_time'];
//Проводим операции
if(isset($_POST['delete_all'])){
	$conn->query("DELETE FROM `chat`");
	echo("Сообщения удалены");
}
if(isset($_POST['delete_msg'])) {
	$query = $conn->prepare('DELETE FROM `chat` WHERE `text` = :dlt_msg');
	$query->bindValue(":dlt_msg", $dlt_msg);
	$query->execute();
	echo("Сообщения, содержащие " . $dlt_msg . " удалены");
}
if(isset($_POST['delete_author'])) {
	$query = $conn->prepare('DELETE FROM `chat` WHERE `name` = :name_user');
	$query->bindValue(":id_user", $id_user);
	$query->execute();
	echo("Все сообщения пользователя удалены");
}
if(isset($_POST['ban_chat'])) {
	$query = $conn->prepare('INSERT * INTO `ban` SET `id` = :id_user, `ban_chat_time` = :ban_time, `ban_chat_about` = :ban_about');
	$query->bindValue(":id_user", $id_user);
	$query->bindValue(":ban_time", $ban_time);
	$query->bindValue(":ban_about", $ban_about);
	$query->execute();
}
if(isset($_POST['ban'])) {
	$query = $conn->prepare('INSERT * INTO `ban` SET `id` = :id_user, `ban_time` = :ban_time, `ban_about` = :ban_about');
	$query->bindValue(":id_user", $id_user);
	$query->bindValue(":ban_time", $ban_time);
	$query->bindValue(":ban_about", $ban_about);
	$query->execute();
}
//Сам чат
echo '
<iframe name="chat" id="chat" height="500" width="500" src="../chat_engine.php#down"></iframe><br>
<form action="" method="post" target="">
    <input type="text" name="message" size="50"><br>
    <input type="submit" name="send_message" valve="Отправить">
';
    $name = $user['name'];
    $message = $_POST['message'];
    $date = date('H:i:s');
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
