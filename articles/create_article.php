<?php
include('../system/func.php');
auth();
banned($user);
?>
    <div class="block-up">
        <form action="handler.php" method="post">
                Заголовок статьи<br>
                <input name="title" type="text" size="20"><br>
                Текст статьи:<br>
                <textarea name="content" cols="30" rows="3"></textarea> <br>
                <input name="submit" type="submit" value="Создать">
        </form>

<?php
echo '
';
    echo '<iframe width="275" srcdoc="';
    text\smile::smile_look();
    echo '"></iframe></div></div>';
    echo '<div class="a-down"><a href="index.php">Назад</a></div>';