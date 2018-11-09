<?php
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
$party = $conn->query("SELECT * FROM `party` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();

if ($party['id'] == '') {
    die('<div class="block">Партия не найдена<div class="a"><a href="../game.php">На главную</a></div></div> ');
}

$leader = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $party['leader'] . "' LIMIT 1")->fetch();
$reg = $conn->query("SELECT * FROM `regions` WHERE `id` = '" . $party['reg'] . "' LIMIT 1")->fetch();
$lname = name($leader);
echo '<div class="block"> <center>Партия ' . $party['name'] . '<hr>Информация<hr></center>Глава партии: ' . $lname . '</br>Описание партии:' . $party['about'] . '</br>Домашний регион:' . $reg['name'] . '<div class="a"><a href=party_members.php?id=' . $id . '>Участники партии</a></div>';
if ($user['party'] == $party['id']) {
    echo '<div class="a"> <a href=leave_party.php>Выйти из партии</a></div>';
}
if ($user['party'] == 0) {
    echo '<div class="a"> <a href=join_party.php?id=' . $party['id'] . '>Вступить в партию</a></div>';
}
echo '<div class="a"> <a href=change_reg.php?id=' . $party['id'] . '>Изменить домашний регион на текущий</a></div>';
if ($leader['id'] == $user['id']) {
    echo '<div class="a">
                <form action="" method="post">
                    <input type="submit" name="prt" value="Управление">
                </form>
      </div></div>
    ';

}
if (isset($_POST['prt'])) {
    echo '
            <div class="block">
                <form action="" method="post">
                    Название партии<br>
                    <div class="a"><input type="text" name="name"></div>
                    <div class="a"><input type="submit" name="edit_name" value="Управление"><br></div>
                    Роспуск партии<br>
                    <div class="a"><a href=../delete/delete_party.php?id=' . $id . '>Роспустить партию</a><br></div>
                </form>
            </div></div>
    ';
    if (isset($_POST['edit_name'])) {
        $name = htmlentities($_POST['name']);
        $query = $conn->prepare('UPDATE `party` SET `name` = :name WHERE `id` = :id');
        $query->bindValue(":name", $name);
        $query->bindValue(":id", $id);
        $query->execute();
        echo '<div class="block">Название измененно</div>';
    }
}
echo '<br>';
if ($user['priv'] > 1) {
    echo '<div class="a"><a href=../delete/delete_party.php?id=' . $id . '>Удалить(адм.)</a></div>';
}
?>
<div class="a"><a href="index.php">В список партий</a></div>
<div class="a"><a href="../game.php">На главную</a></div>
