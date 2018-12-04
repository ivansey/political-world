<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 03.11.18
 * Time: 18:52
 */
include "../system/func.php";
auth();
su_auth($user);
banned($user);

echo '
    <div class="block-up">
    <div class="block-info">
        Создание региона<br>
            <form action="handler.php" method="post">
                <input type="text" name="name">
                <input type="submit" name="create" value="Создать"></div>
            </form>
    </div></div>
';
echo '<div class="a-down"><a href="index.php">Назад</a>';
