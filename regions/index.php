<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 03.11.18
 * Time: 11:01
 */
include("../system/func.php");
auth();
banned($user);



echo '<div class="a-up"><a href="../game.php">Главная</a></div>';
if($user[priv] > 2) {
    echo '<div class="a-middle"><a href="add.php">Создать регион</a></div>';
}

echo '<div class="block-middle">';

echo '
    <div class="block-info">
        <form action="" method="post">
            Поиск региона<br>
            <input type="text" name="party"><br>
            <input type="submit" name="search" value="Поиск">
        </form>
    </div><br>
';
if (isset($_POST['search'])) {
    $regions = $conn->query("SELECT * FROM `regions` WHERE `name` LIKE '%" . $_POST['party'] . "%' ");
}else{
    $regions = $conn->query("SELECT * FROM `regions`");
}

//$regions = $conn->query("SELECT * FROM `regions`");
echo '<div class="block-info">';
while($region=$regions->fetch()){
    echo '<div class="a"><a href="viev.php?id=' . $region['id'] . '">' . $region['name'] . '</a></div>';
}
echo '</div>';
echo '</div>';

echo '<div class="a-down"><a href="../game.php">Главная</a></div>';