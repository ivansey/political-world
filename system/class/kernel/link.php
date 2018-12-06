<?php

namespace kernel;

include '../../func.php';

class link
{
    public static function usertoleader($id)
    {
        global $conn;
        $user_sql = $conn->query("select * from users where id = $id");
        echo '<a href="/goverment/view_leader_priv.php?user_id=' . $id . '">' . $user_sql['name'] . '</a>';
    }
}