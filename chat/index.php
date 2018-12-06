<?php
include('../system/func.php');
auth();
banned($user);
banned_chat($user);
?>
    <div class="block-up">
        <iframe name="chat" id="chat" height="500" width="275" src="engine.php#down"></iframe>
        <!--<div class="chat-fake-frame"><?php
            $user_design = $conn->query("SELECT * FROM `styles` WHERE `id` = '" . $user[style] . "' LIMIT 1")->fetch();
            echo '<link rel="stylesheet" href="' . $user_design["path"] . '" type="text/css">';
            echo '<div class="chat" id="chat">';
            $messages = $conn->query("SELECT * FROM `chat`");
            while($message=$messages->fetch()){
                $time = date("H:i", strtotime($message['time']));
                $text = $message['text'];
                $text = text\BBcode::tohtml($text, true);
                $text = text\smile::tosmile($text);
                $msg = $message['name'] . " [" . $time . "] " . " : " . $text . "<br>";
                echo($msg);
            }
            echo '</div>';
            ?></div>-->
        <form action="" method="post" target="">
            <div class="block-info-down">
                <input type="text" name="message" size="25">
                <input type="submit" name="send_message" value="Отправить">
            </div>
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
echo '<div class="block-middle"><iframe width="200" srcdoc="';
text\smile::smile_look();
echo '"></iframe></div></div>';
?>
    </form>
    <div class="a-middle"><a href=../game.php>На главную</a></div>
<?php
//Проверка уровня админа и вывод кнопок
if ($user['priv'] >= 1) {
    echo("<div class='a-down'><a href=../admin/chat.php>Управление чатом</a></div>");
}
?>