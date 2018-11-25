<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 10.11.18
 * Time: 19:35
 */
include("../system/func.php");
auth();
banned($user);

$id = _num(_string($_GET['id']));
$datetime = date('Y-m-d H:i:s');
if ($user['id'] == $goverment['king_id']) {
    echo '<div class="block">Вы не имеете право созывать парламент</div>';
}

echo '
<form action="" method="post">
    <div class="block">
    <div class="block-info">
        Создание парламента<br>
        Название паламента<br>
        <input type="text" name="name_parlament"><br>
        Количество стульев<br>
        <select size="3" name="sum">
            <option disabled></option>
            <option value="7">7</option>
            <option value="13">13</option>
            <option value="15">15</option>
        </select></div>
        <div class="a-down"><input type="submit" name="create" value="Создать"></div>
    </div>
</form>
';

if (isset($_POST['create'])) {
    $name = htmlentities($_POST['name_parlament']);
    $sum = $_POST['sum'];
    $reg = $conn->query("SELECT * FROM `goverment` WHERE `id` = " . $id)->fetch();
    $query = $conn->prepare('INSERT INTO `parlament` SET `name` = :name, `sum` = :sum, `gover` = :gover, `reg` = :reg');
    $query->bindValue(":name", $name);
    $query->bindValue(":sum", $sum);
    $query->bindValue(":gover", $id);
    $query->bindValue(":reg", $reg['pri_reg']);
    $query->execute();
    echo '<div class="block">Парламент создан</div>';
}

echo '<div class="a-down"><a href="../game.php">На главную</a></div>';