<?php
include('../system/func.php');
auth();
moder_auth($user);
banned($user);
?>
Денежные средства<br>
<form action="money_edit.php" method="post">
id<br>
<input type="text" name="id"><br>
Рубли<br>
<input type="text" name="money"><br>
Золото<br>
<input type="text" name="gold"><br>
<input type="submit" name="sbm" value="Изменить"><br>
</post>
</form>
