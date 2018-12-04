<?php
include('../system/func.php');
auth();
banned($user);

$a = _string(_num($_GET['id']));
$b = $conn->query("SELECT * FROM company WHERE id = $a")->fetch();

if($b[name] == '') {
echo "<div class='block'>Компания не найдена</div>";
} else {
$c = $conn->query("SELECT * FROM company_type WHERE id = $b[type]")->fetch();
$d = $conn->query("SELECT * FROM users WHERE id = $b[leader]")->fetch();
$e = name($d);
echo "<div class='block'>&#171;$b[name]&#187;</div><br><div class='block'>Тип компании: $c[name]<br>Глава компании: $e</div>";
}
if($user[id] == $b[leader]) {
echo "<br><div class='a'><a href=control.php?id=$a>Управление компанией</a></div>";
} else {
echo "<br><div class='a'><a href=create_contract.php?id=$a>Заключить контракт</a></div>";
}
echo "<br><div class='a'><a href=company_members.php?id=$a>Фабрики компании</a></div>";
echo '<div class="a"><a href=index.php>Назад</a></div>';
?>
