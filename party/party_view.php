<?php
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
$party = $conn->query("SELECT * FROM `party` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();

if ($party['id'] == '') {
    die('<div class="block-up">Партия не найдена<div class="a-down"><a href="../game.php">На главную</a></div></div> ');
}

$leader = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $party['leader'] . "' LIMIT 1")->fetch();
$reg = $conn->query("SELECT * FROM `regions` WHERE `id` = '" . $party['reg'] . "' LIMIT 1")->fetch();
$lname = name($leader);
$aboutt = text\BBcode::tohtml($party['about'], 1);
echo '<div class="block-up"><div class="block-info">Партия ' . $party['name'] . '</div><br><div class="block-info">Глава партии: ' . $lname . '<br>Описание партии:' . $aboutt . '<br>Домашний регион:' . $reg['name'] . '</div><div class="a"><a href=party_members.php?id=' . $id . '>Участники партии</a></div>';
if ($user['party'] == $party['id']) {
    echo '<div class="a"> <a href=leave_party.php>Выйти из партии</a></div>';
}
if ($user['party'] == 0) {
    echo '<div class="a"> <a href=join_party.php?id=' . $party['id'] . '>Вступить в партию</a></div>';
}

if ($leader['id'] == $user['id']) {
    echo '
                <form action="" method="post">
                    <input type="submit" name="prt" value="Управление">
                </form></div>
    ';

}
if (isset($_POST['prt'])) {
    echo '
            <div class="block-middle">
                <form action="" method="post">
                    <div class="block-info">
                        Название партии<br>
                        <input type="text" name="name">
                        <input type="submit" name="edit_name" value="Изменить">
                    </div>
                    <div class="a"><a href=change_reg.php?id=' . $party['id'] . '>Изменить домашний регион на текущий</a></div>
                    <div class="block-info">
                    Роспуск партии<br>
                    <input type="submit" name="dlt" value="Роспуск партии"<br>
                    </div>
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
    if (isset($_POST['dlt'])) {
        $conn->query("DELETE FROM `party` WHERE `id` = " . $id);
        $conn->query("UPDATE `users` SET `party` = 0, `tag` = '' WHERE `party` = ' " . $id . " ' ");
        echo '<div class="block">Партия распущена</div>';
    }
}
if ($user['priv'] > 1) {
    echo '<div class="a"><a href=../delete/delete_party.php?id=' . $id . '>Удалить(адм.)</a></div>';
}
echo '</div>';
?>
<div class="a-middle"><a href="index.php">В список партий</a></div>
<div class="a-down"><a href="../game.php">На главную</a></div>
