<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 13.11.18
 * Time: 17:48
 */
include "../system/func.php";
auth();
su_auth($user);
echo '<div class="a"><a href="index.php">Назад</a></div>';

$log_sum = $conn->query("SELECT COUNT(*) FROM admin_log")->fetch()['COUNT(*)'];
$i = 0;

while ($i < $log_sum) {
    $log = $conn->query("SELECT * FROM admin_log LIMIT " . $i . ",1")->fetch();
    echo '<div class="block"><div class="a">' . name($log['id_user']) . '</div> [' . $log['datetime'] . '] {' . $log['about'] . '}</div><br>';
    $i++;
}

