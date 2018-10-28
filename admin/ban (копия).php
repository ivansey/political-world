<?php
include('../system/func.php');
auth();
moder_auth($user);
banned($user);
if($user['priv'] < 1) {
	header("Location: ../game.php"); exit;
}
?>
Бан/Разбан игроков<br>
<form action="ban_edit.php" method="post">
id<br>
<input type="text" name="id"><br>
<?php echo($datetime); ?>
До скольки ГГГГ-ДД-ММ ЧЧ:ММ:СС если 1<br>
<input type="text" name="time"><br>
Причина<br>
<input type="text" name="about"><br>
<input type="submit" name="sbm" value="Изменить"><br>
</post>
