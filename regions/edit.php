<?php
include('../system/func.php');
auth();
banned($user);
su_auth($user);
$id = _num(_string($_GET['id']));

echo '
    <div class="block-up">
    <div class="block-info">
        <form action="" method="post">
            Имя региона
            <input type="text" name="name">
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
    echo '<div class="block-middle">Регион изменён</div>';
}
echo '</div><div class="a-down"><a href="viev.php?id=' . $id . '">Назад</a>';