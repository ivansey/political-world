<?php
include('../system/func.php');
auth();
banned($user);
//$noheader;

$tag = $_POST['tag'];
try {
    if ($user['gold'] >= 100) {
        $query = $conn->prepare('INSERT INTO `party` SET `name` = :name, `about` = :about, `leader` = :leader, `tag` = :tag, `reg` = :reg');
        $query->bindValue(":name", htmlentities($_POST['name']));
        $query->bindValue(":about", htmlentities($_POST['about']));
        $query->bindValue(":leader", $user['id']);
        $query->bindValue(":tag", htmlentities($tag));
        $query->bindValue(":reg", $user['region']);
        $query->execute();
        $party = $conn->query("SELECT * FROM `party` WHERE `leader` = " . $user['id'] . " ")->fetch();
        $conn->query("UPDATE `users` SET `party` = " . $party['id'] . ", `gold` = `gold` - 100, `tag` = '" . $tag . "' WHERE `id` = " . $user['id'] . " ");
        die("<div class='block'>Партия успешно создана<div class='a'> <a href=/>На главную</a></div></div>");
    } else {
        die('<div class="block">Не хватает золота для создания партии<div class="a"> <a href=create_party.php>Назад</a></div></div>');
    }
} catch (Exception $exception) {/* All exceptions handling */
}
?>
