<?php
include('../system/func.php');
auth();
banned($user);
?>
<div class="block">
<form action="handler.php" method="post"><center>
Название партии:<br>
   <input name="name" type="text" size="20"><br>
Тег партии:<br>
<input name="tag" type="text" size="20"><br>
О партии:<br>
<input name="about" type="text" size="20"><br>
    <div class="a"><input name="submit" type="submit" valve="Редактировать"></div>
</center>
</form>
</div>