<?php
include('../system/func.php');
auth();
banned($user);
su_auth($user);
$id = _num(_string($_GET['id']));

echo '
    <div class="block">
        <form action="" method="post">
            Имя региона
            <input type="text" name="name">
            <div class="a">
                <input type="submit" name="name_edit" value="Изменить">
            </div>
        </form>
    </div>
';

if (isset($_POST['name_edit'])) {
    $name = $_POST['name'];
    $query = $conn->prepare('UPDATE `regions` SET `name` = :name WHERE `id` = :id');
    $query->bindValue(":name", $name);
    $query->bindValue(":id", $id);
    $query->execute();
    echo '<div class="block">Регион изменён<div class="a"><a href="viev.php?id=' . $id . '">Назад</a></div></div>';
}
?>
