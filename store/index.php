<?php
include('../system/func.php');
auth();
banned($user);
$id_user = $user['id'];
$rl = $conn->query("SELECT * FROM store WHERE id = " . $id_user);
$ml = $conn->query("SELECT * FROM resourse");
    echo '
    <div class="block-up"><div class="block-info">';
	while($m = $ml->fetch()) {
echo $m[name] . " | ";
$res = $conn->query("SELECT * FROM store WHERE id = " . $id_user . " AND type = " . $m['id'])->fetch();
echo $res['sum'] . "<br>";
}
echo '</div>
	<form action="" method="post"><input type="submit" name="add" value="+1000 FOOD[НЕ РАБОТАЕТ]"></form></div>
	<div class="a-down"><a href="../game.php">В главное меню</a></div>';
    if (isset($_POST['add'])) {
        $store = new Store($conn, $user['id'], 'food', 1000);
        $add = $store->add();
        header('Location: /store');
    }
?>
