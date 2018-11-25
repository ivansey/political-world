<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 11.11.18
 * Time: 10:35
 */
include '../../system/func.php';
auth();
banned($user);

$id = _num(_string($_GET['id']));
$gover_sql = $conn->query("SELECT COUNT(*) FROM `goverment` WHERE `id` = " . $user['gover'])->fetch()['COUNT(*)'];
$gover = $conn->query("SELECT * FROM `goverment` WHERE `id` = " . $user['gover'])->fetch();
$par = $conn->query("SELECT COUNT(*) FROM `goverment` WHERE `id` = " . $user['gover'] . " AND `elec_par` = 1 ")->fetch()['COUNT(*)'];
$lead = $conn->query("SELECT COUNT(*) FROM `goverment` WHERE `id` = " . $user['gover'] . " AND `elec_lead` = 1 ")->fetch()['COUNT(*)'];

if ($gover_sql == 0) {
    echo '<div class="block">Вы не находитесь в каком либо государстве</div>';
}

if ($par == 1) {
    echo '<div class="block">Выборы в парламент<br>';
    $par_sum = $conn->query("SELECT COUNT(*) FROM `elections_par` WHERE `gover` = " . $id)->fetch()['COUNT(*)'];
    $vote_sum = $conn->query("SELECT SUM(vote) FROM `elections_par` WHERE `gover` = " . $id)->fetch()['SUM(vote)'];
    $i = 1;
    while ($i <= $par_sum) {
        $par_sql = $conn->query("SELECT * FROM `elections_par` WHERE `gover` = " . $id . " LIMIT " . $i)->fetch();
        $party = $conn->query("SELECT * FROM `party` WHERE `id` = " . $par_sql['id_party'])->fetch();
        $procent = $vote_sum * 100 / $par_sql['vote'];
        echo '<div class="block-info">' . $party['name'] . ' | Голосов: ' . $par_sql['vote'] . ' | ' . $procent . '</div>';
        echo '<div class="a-down"><a href="vote.php?id=' . $par_sql['id'] . '&type=1">Проголосовать</a></div><br>';
        $i++;
    }
echo '</div>';
} elseif ($lead == 1) {
    echo '<div class="block">Выборы лидера государства<br>';
    $lead_count = $conn->query("SELECT COUNT(*) FROM `elections_lead` WHERE `gover` = " . $id)->fetch()['COUNT(*)'];
    $vote_sum = $conn->query("SELECT SUM(vote) FROM `elections_lead` WHERE `gover` = " . $id)->fetch()['SUM(vote)'];
    $i = 1;
//    echo $lead_count;
    while ($i <= $lead_count) {
        $user_sql = $conn->query("SELECT * FROM `elections_lead` WHERE `gover` = " . $id . " LIMIT " . $i)->fetch();
        $user_info = $conn->query("SELECT * FROM users WHERE id = " . $user_sql['id_leader'])->fetch();
//        $ = $conn->query("SELECT * FROM `party` WHERE `id` = " . $par_sql['id_party'])->fetch();
        $procent = $vote_sum * 100 / $user_sql['vote'];
        echo '<div class="block-info">' . name($user_info) . ' | Голосов: ' . $user_sql['vote'] . ' | ' . $procent . '</div>';
        echo '<div class="a-down"><a href="vote.php?id=' . $user_sql['id'] . '&type=2">Проголосовать</a></div><br>';
        $i++;
    }
    echo '</div>';
} elseif ($par == 0 AND $lead == 0){
    echo '<div class="block">Никаких выборов не проводится</div>';
}
echo '<div class="a-down"><a href="../view.php?id=' . $id . '">Назад</a></div>';
