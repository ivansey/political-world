<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 11.11.18
 * Time: 9:01
 */
include "../system/func.php";
$conn->query("UPDATE `goverment` SET `elec_par` = 1");
$conn->query("UPDATE `users` SET `vote` = 0");
$conn->query("DELETE FROM `elections_par`");
$party_sql = $conn->query("SELECT COUNT(*) FROM party WHERE gover != 0")->fetch()['COUNT(*)'];
$i = 1;
while ($i <= $party_sql) {
    $party = $conn->query("SELECT * FROM party WHERE gover != 0 LIMIT " . $i . ",1")->fetch();
    $conn->query("INSERT INTO elections_par SET id_party = " . $party['id'] . ", gover = " . $party['gover']);
    $i++;
}