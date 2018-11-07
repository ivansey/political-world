<?php
include('../system/func.php');
auth();
banned($user);

$goverments = $conn->query("SELECT * FROM `goverment`");
while($goverment=$goverments->fetch()){
    echo '<div class="a"><a href="view.php?id=' . $goverment['id'] . '">' . $goverment['name'] . '</a></div>';
}
echo '<br>';
echo '<div class="a"><a href="../game.php">Главная</a></div>';
