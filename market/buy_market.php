<?php
include('../system/func.php');
auth();
banned($user);
$id_market = $_GET['id'];
$market = $conn->query("SELECT * FROM `market` WHERE `id` = " . $id_market . " ")->fetch();
if (isset($_POST['buy'])) {
    $money = $market['price'] * $_POST['res'];
    $type = $market['type'];
    $res = $_POST['res'];
    if ($money > $user['money']) {
        die('<div class="block">Нехватает денег<div class="block"><a href="../game.php">На главную</a></div></div>');
    }
    if ($res > $market['res']) {
        die('<div class="block">У продавца столько товара нет<div class="a"><a href="../game.php">На главную</a></div></div>');
    }
    $conn->query("UPDATE `users` SET `money` = `money` - '" . $money . "' WHERE `id` = '" . $user['id'] . "'");
    $conn->query("UPDATE `users` SET `money` = `money` + '" . $money . "' WHERE `id` = '" . $market['id_user'] . "'");
    //$conn->query("UPDATE `store` SET `" . $type . "` = `" . $type . "` + " . $_POST['res'] . " WHERE `id` = " . $user['id'])
    $conn->query("UPDATE `store` SET `sum` = `sum` + " . $_POST['res'] . " WHERE `id` = " . $user['id'] . " AND `type` = '" . $type . "' ");
    $conn->query("UPDATE `market` SET `res` = `res` - '" . $_POST['res'] . "' WHERE `id` = '" . $market['id'] . "'");
    //$conn->query("UPDATE `store` SET `" . $type . "` = `" . $type . "` + '" . $_POST['res'] . "' WHERE `id` = '" . $user['id'] . "'");
    //$conn->query("UPDATE `store` SET `" . $type . "` = `" . $type . "` - '" . $_POST['res'] . "' WHERE `id` = '" . $market['id_user'] . "'");
    $market_new = $conn->query("SELECT * FROM `market` WHERE `id` = " . $id_market . " ")->fetch();
    if ($market_new['res'] == 0) {
        $conn->query("DELETE FROM `market` WHERE `res` = 0");
    }
    echo 'Транзакция завершена<br>';
}
echo "<div class='a'><a href=market.php?id=$id_market>Назад</a></div>";
echo '<div class="a"><a href="../game.php">На главную</a></div>';
?>
