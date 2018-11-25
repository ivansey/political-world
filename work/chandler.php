<?php
include('../system/func.php');
auth();
banned($user);

$option = $_POST['taskOption'];
$name = $_POST['name'];
$salary = $_POST['salary'];
$res = $_POST['res'];
if ($option) {
    $ftype = $conn->query("SELECT * FROM `factory_types` WHERE `res` = " . $option . " ")->fetch();
    $cost = $ftype[cost];
    if ($ftype['name'] != '') {
        if($user['money'] >= $cost){
        $query = $conn->prepare('UPDATE `users` SET `money` = `money` - :cost WHERE `id` = :id');
             $query->bindValue(":cost", $cost);
            $query->bindValue(":id", $user['id']);
            $query->execute();
            $query = $conn->prepare('INSERT `factory` SET `name` = :name, `type` = :type, `salary_money` = :salary, `salary_res` = :res, `budget_money` = 10000000, `leader` = :id_user');
            $query->bindValue(":name", $name);
            $query->bindValue(":type", $option);
            $query->bindValue(":salary", $salary);
            $query->bindValue(":res", $res);
            $query->bindValue(":id_user", $user['id']);
            $query->execute();
            echo('<div class="block">Фабрика успешно создана</div>');
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
