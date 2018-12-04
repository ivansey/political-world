<?php
include('../system/func.php');
auth();
banned($user);
?>
<div class="block-up">
    Редактирование данных пользователя<br>
    <div class="block-info">
        Смена имени(50 SCR):<br>
        <form action="name_edit.php" method="post">
            <input name="name" type="text" size="20">
            <input name="submit" type="submit" value="Редактировать">
        </form>
    </div><br>
    <div class="block-info">
        О себе:<br>
        <form action="aboutuser_edit.php" method="post">
            <textarea name="about" cols="40" rows="5"></textarea>
            <input name="submit" type="submit" value="Редактировать">
            <br>
        </form>
    </div><br>
    <div class="block-info">
        Загрузить аватар(по ссылке)
        <form action="change_avatar.php" method="post">
            <input type="text" name="url">
            <input type="submit" value="Загрузить">
        </form><br>
        Загрузить аватар(файлом)
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filename">
            <input type="submit" value="Загрузить">
        </form>
    </div>
</div>
<div class="a-down"><a href=index.php>Вернуться</a></div>