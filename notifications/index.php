<?php
include('../system/func.php');
auth();
banned($user);

$su = $conn->query("SELECT COUNT(*) FROM notifications WHERE user = $user[id] AND readen = 0")->fetch()['COUNT(*)'];

if($su == 0) {
echo '<div class="block">Нет новых уведомлений</div>';
} else {
$notifications = $conn->query("SELECT * FROM notifications WHERE user = $user[id] AND readen = 0");
while($notify = $notifications->fetch()) {
echo "<div class='block'>$notify[text]<hr><small>$notify[time]</small></div>";
if($notify[href] != '') {
echo "<div class='a'><a href=$notify[href]>Перейти</a></div>";
}
echo "<br>";
}
$conn->query("UPDATE notifications SET readen = 1 WHERE user = $user[id] AND readen = 0");
$conn->query("DELETE FROM notifications WHERE user=$user[id] AND readen = 1");
}

echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
