<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 27.11.18
 * Time: 21:56
 */
include '../system/func.php';
//include '../system/class/laws.php';
//__class();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use system\laws;

$gover_sql_count = $conn->query("select count(*) from goverment")->fetch()['count(*)'];
$time = date("Y-m-d H:i:s");
$datetime = strtotime($time) + strtotime("0000-00-01 00:00:00") - strtotime("0000-00-00 00:00:00");
$sql_time = date("Y-m-d H:i:s", $datetime);
$i = 0;
while ($i < $gover_sql_count) {
    $gover_sql = $conn->query("select * from goverment limit " . $i . ",1")->fetch();
    $law_sql_count = $conn->query("select count(*) from elections_law where agree > disagree and (gover_id = " . $gover_sql['id'] . ") ")->fetch()['count(*)'];
    //$law_sql_prew = $conn->query("select * from elections_law where agree > disagree and (gover_id = " . $gover_sql['id'] . ") ")->fetch();
    $i2 = 0;
    while ($i2 < $law_sql_count) {
        $law_sql = $conn->query("select * from elections_law where agree > disagree and (gover_id = " . $gover_sql['id'] . ") limit " . $i2 . ",1")->fetch();
        echo 'test';
        system\laws::sussed_laws($law_sql['id']);
        system\laws::delete_elections_law($law_sql['id']);
        echo $i2;
        $i2++;
    }
    $i++;
}