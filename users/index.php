<?php
include('../system/func.php');
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
echo '<div class="block-up">';
if ($name == '') {
    echo 'Данный игрок не существует';
} else {
    if ($id == $user['id'] or $id == 0) {

        echo '<div class="avatar" style="background-image: url(' . $user['avatar'] . ')"></div>';
        echo '<div class="block-info-down">';
        echo 'id: ' . $id_user . '<br>EMAIL: ' . $email . '<br>Имя: ' . $name . ' <br> ' . $user[lvl] . ' lvl(' . $user[exp] . '/' . $user[nexp] . ')</br>';
        if ($about == '') {
        } else {
            echo 'О себе: ' . text\BBcode::tohtml($about, 1) . '</br>';
        }
        echo '' . $money . ' RUB<br>' . $gold . ' SCR';
        echo '<br>Дата регистрации:  ' . $user["date_reg"];
        echo '</div>';
        echo '</div><div class="block-middle"><div class="a"><a href=edit.php>Редактировать данные</a></div><div class="a"> <a href="../setting/index.php">Настройки</a><br></div></div>';
    } else {
        echo '<div class="avatar" style="background-image: url(' . $anek['avatar'] . ')"></div>';
        echo '<div class="block-info-down">Имя: ' . $name . ' <br> ' . $anek[lvl] . ' lvl(' . $anek[exp] . '/' . $anek[nexp] . ')</br>';
        if ($about == '') {
        } else {
            echo 'О себе: ' . text\BBcode::tohtml($about, 1) . '</br> ';
        }
        echo '</div></div>';
        echo '<div class="a-middle"><a href="/mail/mail.php?id=' . $id . '">Открыть сообщения</a></div>';
    }

}
?>
<div class="a-down"><a href=../game.php>Главная</a></div>
