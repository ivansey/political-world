<?php /** @noinspection ALL */
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 26.11.18
 * Time: 15:37
 */
include '../system/func.php';

use system;

//php_error_log();

$type = $_POST['type'];
$gover_id = $_POST['gover_id'];

$info = new goverment\info($gover_id);
$gover_info = $info->info();
$priv_leader = $info->priv_leader();
echo '1';
if ($_POST['type'] == 'change_name') {
    echo '
        <div class="block-up">
            <div class="block-info">
                <form action="" method="post">
                    <input type="hidden" name="type" value="change_name">
                    <input type="hidden" name="gover_id" value="' . $_POST['gover_id'] . '">
                    Изменение названия<br>
                    <input type="text" name="name">
                    <input type="submit" name="submit_2" value="Издать">
                </form>
            </div>
        </div>
        ';
} elseif ($_POST['type'] = 'change_priv_leader') {
    echo '
        <div class="block-up">
            <div class="block-info">
                <form action="" method="post">
                    <input type="hidden" name="type" value="change_priv_leader">
                    <input type="hidden" name="gover_id" value="' . $_POST['gover_id'] . '">
                    Изменение привелегий лидера<br>
                    Изменение информиции<br>
                    <select name="change_info">
                        <option value="0">Не разрешать</option>
                        <option value="1">Разрешать</option>
                    </select><br>
                    Изменение парламента<br>
                    <select name="change_parl">
                        <option value="0">Не разрешать</option>
                        <option value="1">Право вето</option>
                        <option value="2">Изменение информации и право вето</option>
                        <option value="3">Полные права</option>
                    </select><br>
                    Изменение экономики<br>
                    <select name="change_economic_laws">
                        <option value="0">Не разрешать</option>
                        <option value="1">Изменение инфраструктыры</option>
                        <option value="2">Инфрструктура и изменение налогов</option>
                        <option value="3">Полные права</option>
                    </select><br>
                    Изменение армии<br>
                    <select name="change_army">
                        <option value="0">Не разрешать</option>
                        <option value="1">Усиление защиты</option>
                        <option value="2">Полные права</option>
                    </select><br>
                    Изменение специальных законов<br>
                    <select name="change_special_laws">
                        <option value="0">Не разрешать</option>
                        <option value="1">Разрешать</option>
                    </select><br>
                    Изменение соглашений между государств<br>
                    <select name="change_contract">
                        <option value="0">Не разрешать</option>
                        <option value="1">Экономические соглашения</option>
                        <option value="2">Односторонние эконом. согл</option>
                        <option value="3">Военные соглашения</option>
                        <option value="4">Односторонние соглашения</option>
                        <option value="5">Полные законы</option>
                    </select><br>
                    <input type="submit" name="submit_2" value="Издать">
                </form>
            </div>
        </div>
        ';
}
//laws::sql_add_elec($type, name($user) . ' предлагает изменить название государства на ' . htmlentities($_POST['name']), htmlentities($_POST['name']), $_POST['gover_id'], $user['id']);
if ($_POST['type'] == 'change_name') {
    $about = 'Изменение названия государства на ' . $_POST['name'];
} elseif ($_POST['type'] == 'change_priv_leader') {
    $about = '
        Изменение привелегий лидера государства на:<br>
        Изменение информации' . $_POST['change_info'] . '<br>
        Парламент' . $_POST['change_parl'] . '<br>
        Экономика' . $_POST['change_economic_laws'] . '<br> 
        Армия' . $_POST['change_army'] . '<br>
        Спец. законы' . $_POST['change_special_laws'] . '<br>
        Соглашения' . $_POST['change_contract'];
}
if (isset($_POST['submit_2'])) {
    \system\laws::sql_add_elec($type, $_POST['name'], $_POST['gover_id'], $user['id'], $about, $priv_lead = array('info' => $_POST['change_info'], 'parl' => $_POST['change_parl'], 'econom' => $_POST['change_economic_laws'], 'army' => $_POST['change_army'], 'spec' => $_POST['change_special_laws'], 'contract' => $_POST['change_contract']));
    echo '<div class="block-middle"> Закон принаят на рассмотрение</div>';
}
//laws::sql_add_elec($type, name($user) . ' предлагает изменить название государства на ');

echo '<div class="a-down"><a href="../parliament/index.php?id=' . $gover_id . '">На главную</a> </div>';