<?php
include('../system/func.php');
auth();
banned($user);
?>
<div class="block-up">
    <form action="handler.php" method="post">
        Название партии:<br>
        <input name="name" type="text" size="20"><br>
        Тег партии:<br>
        <input name="tag" type="text" size="20"><br>
        О партии:<br>
        <input name="about" type="text" size="20"><br>
        <input name="submit" type="submit" value="Создать">
    </form>
</div>
<div class="a-down"><a href="index.php">Назад</a></div>