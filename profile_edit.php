<?php
include('system/func.php');
auth();
banned($user);
?>
<div class="block">
<h4>Редактирование данных пользователя</h4><br>
Смена имени(50 G):<br>
<form action="name_edit.php" method="post">
    <input name="name" type="text" size="20">
    <div class="a"><input name="submit" type="submit" valve="Редактировать"><br></div>
</form>
О себе:<br>
<form action="aboutuser_edit.php" method="post">
    <textarea name="about" cols="40" rows="5"></textarea>
    <div class="a"> <input name="submit" type="submit" valve="Редактировать"></div><br>
</form></div>
<div class="a"> <a href=profile_viev.php>Вернуться</a></div>
