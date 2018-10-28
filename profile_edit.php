<?php
include('system/func.php');
auth();
banned($user);
?>
<h4>Редактирование данных пользователя</h4><br>
Смена имени(50 G):<br>
<form action="name_edit.php" method="post">
    <input name="name" type="text" size="20">
    <input name="submit" type="submit" valve="Редактировать"><br>
</form>
О себе:<br>
<form action="aboutuser_edit.php" method="post">
    <textarea name="about" cols="40" rows="5"></textarea>
    <input name="submit" type="submit" valve="Редактировать"><br>
</form>
<a href=profile_viev.php>Вернуться</a>
