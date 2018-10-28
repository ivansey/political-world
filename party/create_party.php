<?php
include('../system/func.php');
auth();
banned($user);
?>
<form action="handler.php" method="post"><center>
Название партии:<br>
   <input name="name" type="text" size="20"><br>
Тег партии:<br>
<input name="tag" type="text" size="20"><br>
О партии:<br>
<input name="about" type="text" size="20"><br>
    <input name="submit" type="submit" valve="Редактировать">
</center>
</form>
