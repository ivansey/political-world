<?php
include('../system/func.php');
auth();
banned($user);
echo '<div class="a"><a href="../game.php">Главная</a></div>';
echo '<br>';
$goverments = $conn->query("SELECT * FROM `goverment`");
while($goverment=$goverments->fetch()){
    echo '<div class="a"><a href="view.php?id=' . $goverment['id'] . '">' . $goverment['name'] . '</a></div>';
}


