<?php
include('../system/func.php');
auth();
banned($user);
banned_chat($user);
$noheader;
$user_design = $conn->query("SELECT * FROM `styles` WHERE `id` = '" . $user[style] . "' LIMIT 1")->fetch();
echo '<link rel="stylesheet" href="' . $user_design["path"] . '" type="text/css">';
echo '<div class="chat">';
$messages = $conn->query("SELECT * FROM `chat`");
while($message=$messages->fetch()){
    $time = date("H:i", strtotime($message['time']));
    //$time = rtrim($messages['time'], "/0");
    $text = $message['text'];
    //$text = str_ireplace(':)', '<img src="http://yoursmileys.ru/ksmile/bleus/k0901.png">', $text);
    $text = BBcode::tohtml($text);
    $text = text_smile($text);
    $msg = $message['name'] . " [" . $time . "] " . " : " . $text . "<br>";
    echo($msg);
}
echo '</div>';
?>
<meta http-equiv="Refresh" content="5" />
<a name="down"></a>
