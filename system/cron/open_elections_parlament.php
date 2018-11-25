<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 11.11.18
 * Time: 9:01
 */
include "../func.php";
$conn->query("UPDATE `goverment` SET `elec_par` = 1");
$conn->query("UPDATE `users` SET `vote` = 0");
$conn->query("DELETE FROM `elections_par`");