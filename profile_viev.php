<?php
include('system/func.php');
auth();
banned($user);

$id = _string(_num($_GET['user_id']));
if ($id == 0 or $id == $user['id']) {
    $email = $_COOKIE['email'];
    $anek = $conn->query("SELECT * FROM `users` WHERE `mail` = '" . $email . "' LIMIT 1")->fetch();
} else {
    $anek = $conn->query("SELECT * FROM `users` WHERE `id` = '" . $id . "' LIMIT 1")->fetch();
    $email = $anek['mail'];
}

// $name = $anek['name'];
$name = name($anek);
$money = $anek['money'];
$gold = $anek['gold'];
$about = $anek['about'];
$id_user = $anek['id'];
echo '<div class="block">';
if ($name == '') {
    echo 'Данный игрок не существует';
} else {
    if ($id == $user['id'] or $id == 0) {
        echo 'id: ' . $id_user . '<br>EMAIL: ' . $email . '<br>Имя: ' . $name . ' - '.$user[lvl].' lvl('.$user[exp].'/'.$user[nexp].')</br>';
        if ($about == '') {
        } else {
            echo 'О себе: ' . $about . '</br>';
        }
        echo '' . $money . ' RUB<br>' . $gold . ' G';
	echo '<br>Дата регистрации:  '. $user["date_reg"]; 
        echo '</br></div><div class="a"><a href=profile_edit.php>Редактировать данные</a></div><br><div class="a"> <a href="settings.php">Настройки</a><br></div>';
    } else {
        echo 'Имя: '.$anek[tag].'' . $name . ' - '.$anek[lvl].' lvl('.$anek[exp].'/'.$anek[nexp].')</br>';
        if ($about == '') {
        } else {
            echo 'О себе: ' . $about . '</br> ';
        }
        echo '</div>';
    }

}
?>
<div class="a"> <a href=game.php>Главная</a></div>
