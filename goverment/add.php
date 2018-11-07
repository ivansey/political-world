<?php
include "../system/func.php";
auth();
banned($user);

$reg_id = _num(_string($_GET['reg_id']));

echo '
    <div class="block">
        Создание государства<br>
        <div class="a">
            <form action="handler.php" method="post">
                <input type="text" name="name">
                <input type="hidden" name="reg_id" value="' . $reg_id . '">
                <input type="submit" name="create" value="Создать">
            </form>
        </div>
    </div>
';
