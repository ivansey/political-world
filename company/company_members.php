<?php
include('../system/func.php');
auth();
banned($user);

$g = _string(_num($_GET['id']));
$a = $conn->query("SELECT * FROM company_members WHERE cid=$g");
$c= $conn->query("SELECT * FROM company_members WHERE cid = $g")->fetch();


if($c[fid] == '') {
echo "<div class='block'>Фабрик нет</div>";
} else {
echo "<div class='block'>";
while($b=$a->fetch()) {
$h = $conn->query("SELECT * FROM factory WHERE id = $b[fid]")->fetch();
echo "<div class='a'><a href=../work/factory_viev.php?factory_id=$h[id]>$h[name]</a></div><br>";
}
echo "</div><br>";
}
echo "<div class='a'><a href=company.php?id=$g>Назад</a></div>";
?>
