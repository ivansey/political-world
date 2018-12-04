<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));
$company = $conn->query("SELECT * FROM company WHERE id = $id")->fetch();

if($company[leader] == $user[id]) {
echo '<div class="block">Контракт с самим собой?</div>';
} else {
echo "<div class='block'>Контракт с &#171;$company[name]&#187;</div>";
echo "<br><div class='block'>Отдаете в аренду:<br><form action='candler.php' method='post'><select name='taskOption'>";
$factories = $conn->query("SELECT * FROM factory WHERE leader= $user[id]");
while($factory=$factories->fetch()){
echo "<div class='block'> <option value=$factory[id]>$factory[name]</option>";
}
   echo "</select><br><br>На срок до:<br> <input type='date' name='date'/><br><br>За:<br><input type='number' name='money'/> RUB<br><br><input type='submit' value='Отправить'/><input type='hidden' name='company' value=$id></form>";
    echo "</div>";
}
echo "<div class='a'><a href=company.php?id=$id>Назад</a></div>";
?>
