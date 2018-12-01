<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 25.11.18
 * Time: 13:36
 */
include '../system/func.php';
auth();
banned($user);

echo '
<div class="block">
<div class="block-info">
<form action="mail.php" method="get">
Введите id игрока<br>
<input type="text" name="id">
<input type="submit" name="submit" value="Открыть диалог">
</form>
</div>
</div>
<div class="a-down"><a href="index.php">Назад</a></div>
';