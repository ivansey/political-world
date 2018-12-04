<?php
include('../system/func.php');
banned($user);
auth();

if ($user['party'] == 0) {
    echo '<div class="a-up"><a href=create_party.php>Создать партию(100G)</a></div><div class="a-middle"><a href=../game.php>На главную</a></div>';
} else {
    echo '<div class="a-up"><a href=../game.php>На главную</a></div>';
}
echo '<div class="block-middle">';

echo '
    <div class="block-info">
        <form action="" method="post">
            Поиск партии<br>
            <input type="text" name="party"><br>
            <input type="submit" name="search" value="Поиск">
        </form>
    </div><br>
';
if (isset($_POST['search'])) {
    $partys = $conn->query("SELECT * FROM `party` WHERE `name` LIKE '%" . $_POST['party'] . "%' ");
}else{
    $partys = $conn->query("SELECT * FROM `party`");
}
echo '<div class="block-info"> Список партий:<br>';
while ($party = $partys->fetch()) {
    echo '<div class="a"><a href=party_view.php?id=' . $party['id'] . '>' . $party['name'] . '</a></div><br>';
}
echo '</div></div>';
echo '<div class="a-down"><a href=../game.php>На главную</a></div>';