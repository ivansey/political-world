<?php
include('../system/func.php');
auth();
banned($user);
?>
    <div class="block">
        <form action="handler.php" method="post">
            <center>
                Заголовок статьи<br>
                <input name="title" type="text" size="20"><br>
                Текст статьи:<br>
                <textarea name="content" cols="30" rows="3"></textarea> <br>
                <div class="a"><input name="submit" type="submit" value="Создать">

            </center>
        </form>

<?php
echo '
<form method="post"><input name="smile" type="submit" value="Показать смайлы"></div></div></form>
';
if (isset($_POST['smile'])) {
    echo '<div class="block"><iframe width="275" srcdoc="';
    look_smile();
    echo '"></iframe></div></div>';
}