<?php
include('../system/func.php');
auth();
banned($user);

$a = $conn->query("SELECT * FROM company");
$c = $conn->query("SELECT * FROM company")->fetch();

echo "<div class='a-middle'><a href=create.php>Создать компанию</a></div>";

if($c[id] == '') {
echo "<div class='block'>Компаний нет</div>";
}
echo "<div class='block'>";
while($b=$a->fetch()) {
echo "<div class='a'><a href=company.php?id=$b[id]>$b[name]</a></div><br>";
}
echo "</div>";
?>
