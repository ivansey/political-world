<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 02.11.18
 * Time: 16:19
 */
include('../system/func.php');
auth();
banned($user);
$resources = $conn->query("SELECT * FROM resource");
?>
<div class="block">
<?php
while($res=$resources->fetch()) {
echo "<div class='a'><a href=market.php?id=$res[id]>Искать $res[name]</a></div>";
}
?>
</div>
<div class="a"><a href="../game.php">На главную</a></div>
