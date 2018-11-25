<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 11.11.18
 * Time: 9:09
 */
include "../func.php";
$conn->query("UPDATE `goverment` SET `elec_lead` = 1");
$conn->query("UPDATE `users` SET `vote` = 0");
$conn->query("DELETE FROM `elections_lead`");