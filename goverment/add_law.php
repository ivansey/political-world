<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 06.12.18
 * Time: 6:46
 */
include '../system/func.php';
auth();
banned($user);

$id = _num(_string($_GET['id']));

$info = new goverment\info($id);

$priv = new goverment\leader_priv($id);

switch ($_GET['type']) {
    default:
        echo '
            <div class="block-up">
            Издание закона<br>
            <form action="" method="get">
            <input type="hidden" name="id" value="' . $id . '">
            <select name="type">
        ';
        if ($priv->priv_change_gov_info == 1) {
            echo '<option value="gov_name">Изменение информации о государстве</option>';
        }
        echo '
            </select>
            <input type="submit" name="submit" value="Издать">
            </form>
            </div>
        ';
        break;
    case 'gov_name':
        echo '
            <div class="block-up">
                <form action="" method="get">
                    <input type="hidden" name="id" value="' . $id . '">
                    <input type="hidden" name="type" value="gov_name_change">
        ';

        if ($priv->priv_change_gov_info == 1) {
            echo '
                    <div class="block-info">
                        Название государства
                        <input type="text" name="name">
                    </div>
            ';
        }

        echo '
                    <input type="submit" name="gov_edit" value="Изменить">
                </form>
            </div>
        ';
        break;
    case 'gov_name_change':
        goverment\info::change_name($_GET['id'], $_GET['name']);
        echo '<div class="block-up">Имя государства изменено</div>';
        break;
}

echo '<div class="a-down"><a href="view.php?id=' . $_GET['id'] . '">Назад</a></div>';
