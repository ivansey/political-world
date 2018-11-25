<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 11.11.18
 * Time: 16:54
 */
include "../../system/func.php";
auth();
banned($user);
$test = 'test';
$id = _num(_string($_GET['id']));
$type = _num(_string($_GET['type']));

switch ($type) {
    case 1:

        $elec_sql = $conn->query("SELECT COUNT(*) FROM elections_par WHERE id = $id")->fetch()['COUNT(*)'];
        $elec = $conn->query("SELECT * FROM elections_par WHERE id = $id")->fetch();
        if ($elec_sql == 0) {
            echo '<div class="block">Данного кандидата не существует</div><div class="a-down"><a href="index.php">Назад</a></div>';
            exit;
        }
        if ($user['gover'] != $elec['gover']) {
            echo '<div class="block">Данного кандидата не существует</div><div class="a-down"><a href="index.php">Назад</a></div>';
            exit;
        }
        if ($user['vote'] == 1) {
            echo '<div class="block">Вы уже отдали свой голос</div><div class="a-down"><a href="index.php">Назад</a></div>';
            exit;
        }

        $conn->query("UPDATE `elections_par` SET `vote` = `vote` + 1 WHERE `id` = " . $id);
        $conn->query("UPDATE `users` SET `vote` = 1 WHERE `id` = " . $user['id']);
        break;
    case 2:

        $elec_sql = $conn->query("SELECT COUNT(*) FROM elections_lead WHERE id = $id")->fetch()['COUNT(*)'];
        $elec = $conn->query("SELECT * FROM elections_lead WHERE id = $id")->fetch();
        if ($elec_sql == 0) {
            echo '<div class="block">!Данного кандидата не существует</div><div class="a-down"><a href="index.php">Назад</a></div>';
            exit;
        }
        if ($user['gover'] != $elec['gover']) {
            echo '<div class="block">Данного кандидата не существует</div><div class="a-down"><a href="index.php">Назад</a></div>';
            exit;
        }
        if ($user['vote'] == 1) {
            echo '<div class="block">Вы уже отдали свой голос</div><div class="a-down"><a href="index.php">Назад</a></div>';
            exit;
        }

        $conn->query("UPDATE `elections_lead` SET `vote` = `vote` + 1 WHERE `id` = " . $id);
        $conn->query("UPDATE `users` SET `vote` = 1 WHERE `id` = " . $user['id']);
        break;
}
echo '<div class="block">Вы проголосовали</div><div class="a-down"><a href="index.php">Назад</a></div>';
