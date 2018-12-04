<?php
include('../system/func.php');
auth();
banned($user);
echo '<div class="a-up"><a href="../game.php">Главная</a></div>';
echo '<div class="block-middle">';
echo '
    <div class="block-info">
        <form action="" method="post">
            Поиск государства<br>
            <input type="text" name="party"><br>
            <input type="submit" name="search" value="Поиск">
        </form>
    </div><br>
';
if (isset($_POST['search'])) {
    $goverments = $conn->query("SELECT * FROM `goverment` WHERE `name` LIKE '%" . $_POST['party'] . "%' ");
}else{
    $goverments = $conn->query("SELECT * FROM `goverment`");
}

echo '<div class="block-info">';
while($goverment=$goverments->fetch()){
    echo '<div class="a"><a href="view.php?id=' . $goverment['id'] . '">' . $goverment['name'] . '</a></div>';
}
echo '</div></div>';
echo '<div class="a-down"><a href="../game.php">Главная</a></div>';

