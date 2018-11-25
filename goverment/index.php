<?php
include('../system/func.php');
auth();
banned($user);
echo '<div class="a-down"><a href="../game.php">Главная</a></div>';
echo '<br>';
echo '<div class="block">';
$goverments = $conn->query("SELECT * FROM `goverment`");
while($goverment=$goverments->fetch()){
    echo '<div class="a"><a href="view.php?id=' . $goverment['id'] . '">' . $goverment['name'] . '</a></div>';
}
echo '</div>';


