<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 27.11.18
 * Time: 17:47
 */
include '../system/func.php';
auth();
banned($user);

$id = _num(_string($_GET['id']));
//$type = _num(_string($_GET['id']));

function type_name($type_law){
    if ($type_law == 'change_name') {
        $type_law_name = 'Изменение имени государства';
    }
    return $type_law_name;
}



switch ($_GET['type']) {
    case 'law_vote':
        echo '<div class="block-up">';
        $law_sql_count = $conn->query("select COUNT(*) from elections_law where gover_id = " . $id)->fetch()['COUNT(*)'];
        $i = 0;
        while ($i < $law_sql_count) {
            $law_sql = $conn->query("select * from elections_law where gover_id = " . $id . " limit " . $i . ",1")->fetch();
            echo '<div class="block-info">' . $law_sql['about'] . '<br>type: ' . type_name($law_sql['type']) . '<br>value: ' . $law_sql['value'] . '<br>agree: ' . $law_sql['agree'] . '<br>disagree: ' . $law_sql['disagree'] . '<div class="a"><a href="laws.php?type=agree&id=' . $user['id'] . '&law_id=' . $law_sql['id'] . '">За</a></div><div class="a"><a href="laws.php?type=disagree&id=' . $user['id'] . '&law_id=' . $law_sql['id'] . '">Против</a></div></div>';
            $i++;
        }
        echo '</div>';
        break;
    case 'agree':
        //laws::sql_add_law_vote_agree($_GET['law_id'], $user['id']);
        $law_count = $conn->query("select COUNT(*) from elections_law_user where user_id = " . $user['id'] . " and law_id = " . $_GET['law_id'])->fetch()['COUNT(*)'];
        if ($law_count == 0) {
            $conn->query("update elections_law set agree = agree + 1 where id = " . $_GET['law_id']);
            $conn->query("insert into elections_law_user set user_id = " . $user['id'] . ", law_id = " . $_GET['law_id']);
            echo '<div class="block-up">Вы проголосовали</div>';
        }else{
            echo '<div class="block-up">Вы уже ранее проголосовали</div>';
        }
        break;
    case 'disagree':
        $law_count = $conn->query("select COUNT(*) from elections_law_user where user_id = " . $user['id'] . " and law_id = " . $_GET['law_id'])->fetch()['COUNT(*)'];
        if ($law_count == 0) {
            $conn->query("update elections_law set disagree = disagree - 1, time = " . date("Y-m-d H:i:s") . " + '0000-00-01' where id = " . $_GET['law_id']);
            $conn->query("insert into elections_law_user set user_id = " . $user['id'] . ", law_id = " . $_GET['law_id']);
            echo '<div class="block-up">Вы проголосовали</div>';
        } else{
            echo '<div class="block-up">Вы уже ранее проголосовали</div>';
        }
        //echo '<div class="block">' . laws::sql_add_law_vote_disagree($_GET['law_id'], $user['id']) . '</div>';
        break;
    default:
        echo 'error';
}

echo '<div class="a-down"><a href="index.php?id=' . $id . '">На главную</a></div>';