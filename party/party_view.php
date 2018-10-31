<?php
include('../system/func.php');
auth();
banned($user);
$id = _string(_num($_GET['id']));
$party = $conn->query("SELECT * FROM `party` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();

if ($party[id] == '') {
    die('Партия не найдена');
}

$leader = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $party[leader] . "' LIMIT 1")->fetch();
$lname = name($leader);
echo '<center>Партия ' . $party[name] . '<hr>Информация<hr></center>Глава партии: ' . $lname . '</br>Описание партии:' . $party[about] . '<br><a href=party_members.php?id=' . $id . '>Участники партии</a>';
if ($user[party] == $party[id]) {
    echo '<a href=leave_party.php>Выйти из партии</a>';
}
if ($user[party] == 0) {
    echo '<a href=join_party.php?id=' . $party['id'] . '>Вступить</a>';
}
if ($leader[id] == $user[id]) {
    echo '
        <hr><center>Управление</center><hr>
            <form action="" method="post">
                <input type="submit" name="edit" value="Управление"><br>
            </form>
    ';
    if(isset($_POST['edit'])) {
        echo '
            <form action="" method="post">
                Изменить информацию партии<br>
                <input type="text" name="about"><br>
                <input type="submit" name="edit_about" value="Изменение"><br>
                Передать управление партией<br>
                <input type="text" name="id_user"><br>
                <input type="submit" name="edit_id_user" value="Передать"><br>
            </form>
        ';
    }
}
if (isset($_POST['edit_about'])) {
    $about = $_POST['about'];
    $about = htmlentities($about);
    $query = $conn->prepare('UPDATE `party` SET `about` = :about WHERE `id` = :id');
    $query->bindValue(":about", $about);
    $query->bindValue(":id", $id);
    $query->execute();
    echo 'Информация изменена';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
if (isset($_POST['edit_id_user'])) {
    $id_user = $_POST['id_user'];
    $id_user = htmlentities($id_user);
    $leader = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $id_user . "'")->fetch();
    if ($leader['party'] != $id) {
        die('Данный человек не состоит в этой партии. Перезагрузка через секунду...<meta http-equiv="Refresh" content="1" />');
    }
    //echo 'Вы точно хотите передать управление партией данному человеку: ' . $leader['name'] . '<br>';
    //echo '
    //        <form action="" method="post">
    //            <input type="submit" name="yes" value="Да"><br>
   //             <input type="submit" name="no" value="Нет"><br>
    //        </form>
    //    ';
    $query = $conn->prepare('UPDATE `party` SET `leader` = :id_user WHERE `id` = :id');
    $query->bindValue(":id_user", $leader['id']);
    $query->bindValue(":id", $id);
    $query->execute();
    echo 'Власть передана';
    echo 'Перезагрузка через секунду';
    echo '<meta http-equiv="Refresh" content="1" />';
}
echo '<a href="../game.php">На главную</a>';
?>
