<?php
$noheader = 0;
include('../system/func.php');
auth();
banned($user);
banned_chat($user);
$user_design = $conn->query("SELECT * FROM `styles` WHERE `id` = '" . $user[style] . "' LIMIT 1")->fetch();
echo '<link rel="stylesheet" href="' . $user_design["path"] . '" type="text/css">';
//echo '<div class="chat" id="chat">';
$messages = $conn->query("SELECT * FROM `chat`");
while($message=$messages->fetch()){
    $time = date("H:i", strtotime($message['time']));
    $text = $message['text'];
    $text = text\BBcode::tohtml($text, true);
    $text = text\smile::tosmile($text);
    echo "<a href='/to.php?url=/users/index.php?id=" . idtoname($message['name']) . "'>" . $message['name'] . "</a>" . " [" . $time . "] " . " : " . $text . "<br>";
    //echo($msg);
}
//echo '</div>';
?>
<meta http-equiv="Refresh" content="5" />
<a name="down"></a>