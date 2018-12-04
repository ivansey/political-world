<?php
include('../system/func.php');
auth();
banned($user);

$option = $_POST['taskOption'];
$name = $_POST['name'];
if ($option) {
    $ftype = $conn->query("SELECT * FROM `company_type` WHERE `id` = " . $option . " ")->fetch();
    if ($ftype['name'] != '') {
        if($user['gold'] >= 1000){
        $query = $conn->prepare('UPDATE `users` SET `gold` = `gold` - :cost WHERE `id` = :id');
             $query->bindValue(":cost", 1000);
            $query->bindValue(":id", $user['id']);
            $query->execute();
            $query = $conn->prepare('INSERT `company` SET `name` = :name, `type` = :type, `leader` = :leader');
            $query->bindValue(":name", $name);
            $query->bindValue(":type", $option);
            $query->bindValue(":leader", $user[id]);
            $query->execute();
            echo('<div class="block">Компания успешно создана</div>');
} else {
echo '<div class="block">Недостаточно средств</div>';
}
    } else {
        die('Ошибка 1');
    }
} else {
    die('Ошибка два');
}


?>
<div class="a"><a href=index.php>Назад</a></div>
