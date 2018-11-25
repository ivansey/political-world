<?php
include('../system/func.php');
auth();
banned($user);
banned_chat($user);
?>
    <div class="block">
        <iframe name="chat" id="chat" height="500" width="275" src="engine.php#down"></iframe>
        <br>
        <form action="" method="post" target="">
            <div class="a"><input type="text" name="message" size="25"><br><br>
                <input type="submit" name="send_message" value="Отправить">
                <input type="submit" name="smile" value="Показать смайлы"></div>
    </div>
<?php
$name = name($user);
$message = $_POST['message'];
$date = date('H:i:s');
$message = htmlentities($message);
if ($_POST['send_message']) {
    $query = $conn->prepare('INSERT INTO `chat` SET `text` = :message, `name` = :name, `time` = TIME_FORMAT(:date, "%H:%i") ');
    $query->bindValue(":message", $message);
    $query->bindValue(":name", $name);
    $query->bindValue(":date", $date);
    $query->execute();
    header('Location: index.php');
    exit;
}
if (isset($_POST['smile'])) {
    echo '<div class="block"><iframe width="275" srcdoc="';
    look_smile();
    echo '"></iframe></div></div>';
}
?>
    </form>
    <div class="a"><a href=../game.php>На главную</a></div>
<?php
//Проверка уровня админа и вывод кнопок
if ($user['priv'] >= 1) {
    echo("<div class='a'><a href=../admin/chat.php>Управление чатом</a></div>");
}
?>