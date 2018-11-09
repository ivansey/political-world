<?php
include('../system/func.php');
auth();
banned($user);
banned_chat($user);
$noheader;

$messages = $conn->query("SELECT * FROM `chat`");
while($message=$messages->fetch()){
$msg = $message['name'] . " [" . $message['time'] . "] " . " : " . $message['text'] . "<br>";
    echo($msg);
}
?>
<meta http-equiv="Refresh" content="5" />
<a name="down"></a>
