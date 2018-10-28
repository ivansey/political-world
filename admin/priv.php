<?php
include('../system/func.php');
auth();
banned($user);
su_auth($user);
?>
Изменение привелегий пользователей<br>
id<br>
<form action="priv_edit.php" type="post">
<input type="text" name="id"><br>
Уровень привелегий<br>
<input type="text" name="priv"><br>
<input type="submit" name="submit" value="Назначить"><br>
</form>
Уровни:<br>
0:Обычный юзер<br>
1:Модератор<br>
2:Админ<br>
3:Супер-Админ<br>
