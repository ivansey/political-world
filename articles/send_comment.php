<?php
include('../system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['id']));

$article = $conn->query("SELECT * FROM articles WHERE id = $id LIMIT 1")->fetch();

if ($article['id'] == '')
    die('<div class="block">Статья не найдена<div class="a"><a href="index.php">Назад</a></div></div> ');

echo "<div class='block'>
    <form action='chandler.php' method='post'>";
?>
        <center>
            Текст коментария:<br>
            <input name="text" type="text" size="20"><br>
<?php
echo '
<input type="hidden" name="id" value="'.$id.'"></div>';
?>
            <div class="a"><input name="submit" type="submit" valve="Отправить">

        </center>
    </form>

<?
echo '
<form method="post"><input name="smile" type="submit" value="Показать смайлы"></div></div></form>
';
if (isset($_POST['smile'])) {
    echo '<div class="block"><iframe width="275" srcdoc="';
    look_smile();
    echo '"></iframe></div></div>';
}
echo "<br><div class='a'><a href=view_comments.php?id=$id>Назад</a></a>";
?>
