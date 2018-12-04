<?php
include "../func.php";
echo 'echo';
$conn->query("UPDATE `goverment` SET `elec_lead` = 1");
$conn->query("UPDATE `users` SET `vote` = 0");
$lead_sql = $conn->query("SELECT COUNT(*) FROM goverment")->fetch()['COUNT(*)'];
$i = 0;
while ($i < $lead_sql) {
    $gover = $conn->query("SELECT * FROM goverment LIMIT " . $i . ",1")->fetch();
    $party_sql = $conn->query("SELECT COUNT(*) FROM party WHERE gover = " . $gover['id'])->fetch()['COUNT(*)'];
    $i2 = 0;
    while ($i2 < $party_sql) {
        $party = $conn->query("SELECT * FROM party WHERE gover = " . $gover['id'] . " LIMIT " . $i2 . ",1")->fetch();
        $conn->query("INSERT INTO elections_lead SET gover = " . $gover['id'] . ", id_leader = " . $party['leader']);
        $i2++;
    }
    $i++;
}