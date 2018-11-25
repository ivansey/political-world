<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 11.11.18
 * Time: 9:10
 */
include "../func.php";
$conn->query("UPDATE `goverment` SET `elec_par` = 0");
$gover = $conn->query("SELECT * FROM ")
$parl = $conn->query("SELECT COUNT(*) FROM parlament WHERE sum = 7")->fetch()['COUNT(*)'];
$i = 0;
while ($i < $parl) {
    $party = $conn->query("SELECT COUNT(*) FROM elections_par ")
}