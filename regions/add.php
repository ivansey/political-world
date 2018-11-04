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
    <div class="block">
        Создание региона<br>
        <div class="a">
            <form action="handler.php" method="post">
                <input type="text" name="name">
                <input type="submit" name="create" value="Создать">
            </form>
        </div>
    </div>
';
