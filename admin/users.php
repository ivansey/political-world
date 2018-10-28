<?php
include('../system/func.php');
auth();
banned($user);
moder_auth($user);
?>
Пользователи<br>
<iframe width="300" heigth="500" src="user_engine.php"></iframe>
<form action="user_engine.php" method="post"><br>
Поиск по имени<br>
<input type="text" name="name"><br>
Поиск по id<br>
<input type="text" name="id"><br>
<input type="submit" name="submit" value="Поиск">
