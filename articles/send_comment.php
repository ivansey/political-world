<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));

$article = $conn->query("SELECT * FROM articles WHERE id = $id LIMIT 1")->fetch();

if ($article['id'] == '')
    die('<div class="block-up">Статья не найдена<div class="a"><a href="index.php">Назад</a></div></div> ');

echo "<div class='block-up'>
    <form action='chandler.php' method='post'>";
?>
            Текст коментария:<br>
            <input name="text" type="text" size="20"><br>
<?php
echo '
<input type="hidden" name="id" value="'.$id.'">';
?>
<input name="submit" type="submit" valve="Отправить">


    </form>

<?
echo '

';
    echo '<iframe width="275" srcdoc="';
    text\smile::smile_look();
    echo '"></iframe></div></div>';
echo "</div></div><div class='a-down'><a href=view_comments.php?id=$id>Назад</a></a>";
?>
