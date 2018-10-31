<?php
include('../system/func.php');
auth();
banned($user);
//$noheader;

$tag = $_POST['tag'];
try {
    if ($user['gold'] >= 100) {
        $query = $conn->prepare('INSERT INTO `party` SET `name` = :name, `about` = :about, `leader` = :leader, `tag` = :tag');
        $query->bindValue(":name", $_POST['name']);
        $query->bindValue(":about", $_POST['about']);
        $query->bindValue(":leader", $user['id']);
        $query->bindValue(":tag", $tag);
        $query->execute();
        $party = $conn->query("SELECT * FROM `party` WHERE `leader` = " . $user['id'] . " ")->fetch();
        $conn->query("UPDATE `users` SET `party` = " . $party['id'] . ", `gold` = `gold` - 100, `tag` = '" . $tag . "' WHERE `id` = " . $user['id'] . " ");
        die("Партия успешно создана<br><a href=/>На главную</a>");
    } else {
        die('Не хватает золота для создания партии<br><a href=create_party.php>Назад</a>');
    }
} catch (Exception $exception) {/* All exceptions handling */
}
?>
