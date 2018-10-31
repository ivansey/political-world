<?php
include('../system/func.php');
banned($user);
auth();



$partys = $conn->query("SELECT * FROM `party`");
echo 'Список партий:<br>';
while($party=$partys->fetch()){
echo '<a href=party_view.php?id='.$party['id'].'>'.$party['name'].'</a><br>';
}

if($user['party'] == 0) {
echo '<hr><a href=create_party.php>Создать партию(100G)</a><hr>';
}

?>
