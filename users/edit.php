<?php
include('../system/func.php');
auth();
banned($user);
?>
<div class="block">
Редактирование данных пользователя<br>
    <div class="block-info">
Смена имени(50 SCR):<br>
<form action="name_edit.php" method="post">
    <input name="name" type="text" size="20">
    <div class="a"><input name="submit" type="submit" value="Редактировать"><br></div>
</form>
    </div>
    <div class="block-info">
О себе:<br>
<form action="aboutuser_edit.php" method="post">
    <textarea name="about" cols="40" rows="5"></textarea>
    <div class="a"> <input name="submit" type="submit" value="Редактировать"></div><br>
</form></div></div>
<div class="a-down"><a href=index.php>Вернуться</a></div>
