<?php
include('../system/func.php');
banned($user);
auth();


$partys = $conn->query("SELECT * FROM `party`");
echo '<div class="block"> Список партий:<br>';
while ($party = $partys->fetch()) {
    echo '<div class="a"><a href=party_view.php?id=' . $party['id'] . '>' . $party['name'] . '</a></div><br>';
}
echo '</div>';
if ($user['party'] == 0) {
    echo '<div class="a"><a href=create_party.php>Создать партию(100G)</a></div>';
}
echo '<div class="a"><a href=../game.php>На главную</a></div>';
?>
