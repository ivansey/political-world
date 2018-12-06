<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 06.12.18
 * Time: 9:06
 */
include '../system/func.php';
auth();
banned($user);

$id = _num(_string($_GET['user_id']));


$user_sql = $conn->query("select * from users where id = $id")->fetch();

$info = new goverment\info($user_sql['gover']);
$priv = new goverment\leader_priv($user_sql['gover']);

if ($info->leader != $user_sql['id']) {
    echo '<div class="block-up">Этот пользователь не занимает важное место в государстве</div><div class="a-down"><a onclick="history.back();">Назад</a></div>';
} else {
    echo '
    <div class="block-up">
    <div class="block-info">
        Имформация о лидере ' . name($user_sql) . '<br>
        Имя ' . name($user_sql) . '<br>
        Права:<br>
        Изменение информации о государстве ' . $priv->priv_change_gov_info . '<br>
        Управление парламентом ' . $priv->priv_change_parl . '<br>
        Издание экономических законов ' . $priv->priv_change_economic_laws . '<br>
        Управление армией ' . $priv->priv_change_army . '<br>
        Издание специальных законов ' . $priv->priv_change_spec_laws . '<br>
        Управление соглашениями ' . $priv->priv_change_contract . '<br>
    </div>
    </div>
    <div class="a-down"><a onclick="history.back();">Назад</a></div>
';
}
