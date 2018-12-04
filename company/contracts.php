<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));
$company = $conn->query("SELECT * FROM company WHERE id = $id")->fetch();

if($company[leader] == $user[id]) {
if(isset($_GET['yes'])) {
$cid = $_GET['contract'];
$con = $conn->query("UPDATE contracts SET status = 1 WHERE id = $cid");
header("Location: contracts.php?id=$id");
}
if(isset($_GET['no'])) {
$cid = $_GET['contract'];
$con = $conn->query("DELETE FROM contracts WHERE id = $cid");
header("Location: contracts.php?id=$id");
}
$contracts = $conn->query("SELECT * FROM contracts WHERE company = $id");
echo "<div class='block'>";
while($contract=$contracts->fetch()) {
$factory = $conn->query("SELECT * FROM factory WHERE id = $contract[factory]")->fetch();
echo "<div class='block'><a href=../work/factory_viev.php?factory_id=$factory[id]>$factory[name]</a> за $contract[cost] до $contract[date]</div>";
if($contract[status] == 0) { 
echo "<a href=contracts.php?id=$id&contract=$contract[id]&yes>[y]</a><a href=contracts.php?id=$id&contract=$contract[id]&no>[n]</a>";
} else {
echo 'Одобрен';
}
echo "<br>";
}
echo '</div>';
} else {
echo '<div class="block">Ошибка</div>';
}
echo '<br><div class="a"><a href=control.php?id=$id>Назад</a></div>';
?>
