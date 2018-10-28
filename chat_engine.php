<?php
include('system/func.php');
auth();
banned($user);
banned_chat($user);
$noheader;
//Проверка количества сообщений
$sql = $conn->query("SELECT COUNT(*) FROM `chat`")->fetch()['COUNT(*)'];
//Вывод сообщений
$i = 0;
while ($i < $sql) {
    $i++;
    $echo = $conn->query("SELECT * FROM `chat` LIMIT " . $i . "," . $i . " ")->fetch();
    $msg = $echo['name'] . " [" . $echo['time'] . "] " . " : " . $echo['text'] . "<br>";
    echo($msg);
}
?>
<meta http-equiv="Refresh" content="2" />
<a name="down"></a>
