<?php
include('../system/func.php');
auth();
banned($user);

$option = $_POST['taskOption'];
$date = $_POST['date'];
$company = $_POST['company'];
$money = $_POST['money'];

$c = $conn->query("SELECT * FROM company WHERE id = $company")->fetch();

if($c[leader] != $user[id]) {
if($option) {
$fuck = $conn->query("SELECT * FROM factory WHERE id = $option")->fetch();
if($fuck[name] != '') {
$query = $conn->prepare('INSERT `contracts` SET `factory` = :factory, `company` = :company, `date` = :date, `cost` = :cost');
$query->bindValue(":factory", $option);
$query->bindValue(":company", $company);
 $query->bindValue(":date", $date);
 $query->bindValue(":cost", $money);
$query->execute();
echo('<div class="block">Контракт отправлен. Глава компании подпишет или отклонит его.</div>');
}
}
}
echo "<div class='a'><a href=company.php?id=$company>Назад</a></div>";
?>
