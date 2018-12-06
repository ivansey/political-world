<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 26.11.18
 * Time: 15:39
 */


namespace system;

include '../func.php';

use goverment;

class laws
{
    public static function create_law($value, $gover_id, $user_id, $conn)
    {

    }

    public static function sql_add_elec($type, $value, $gover_id, $user_id, $about, array $priv_lead)
    {
        global $conn;
        echo 'echo';
        $date = strtotime(date("Y-m-d H:i:s")) + strtotime("0000-00-01 00:00:00") - strtotime("0000-00-00 00:00:00");
        echo date("d", $date);
        $query = $conn->prepare('INSERT INTO elections_law SET type = :type, gover_id = :gover_id, user_id = :user_id, value = :var, time = :time, about = :about, priv_lead_gov_info = :info, priv_lead_parl = :parl, priv_lead_eco_laws = :eco_law, priv_lead_army = :army, priv_lead_spec_laws = :spec_law, priv_lead_contract = :contract');
        $query->bindValue(":type", $type);
        $query->bindValue(":gover_id", $gover_id);
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":var", $value);
        $query->bindValue(":time", date("Y-m-d H:i:s", $date));
        $query->bindValue(":about", $about);
        $query->bindValue(":info", $priv_lead['info']);
        $query->bindValue(":parl", $priv_lead['parl']);
        $query->bindValue(":eco_law", $priv_lead['econom']);
        $query->bindValue(":army", $priv_lead['army']);
        $query->bindValue(":spec_law", $priv_lead['spec']);
        $query->bindValue(":contract", $priv_lead['contract']);
        $query->execute();
    }

    public static function sql_add_law_vote_agree($law_id, $user) {
        global $conn;
        $law_count = $conn->query("select COUNT(*) from elections_law_user where user_id = " . $user . " and law_id = " . $law_id)->fetch()['COUNT(*)'];
        if ($law_count == 1) {
            return 0;
        }
        $conn->query("update elections_law set agree = agree + 1 where id = " . $law_id);
        $conn->query("insert into elections_law_user set user_id = " . $user . ", law_id = " . $law_id);
        return 0;
    }

    public static function sql_add_law_vote_disagree($law_id, $user) {
        global $conn;

        $law_count = $conn->query("select COUNT(*) from elections_law_user where user_id = " . $user . " and law_id = " . $law_id)->fetch()['COUNT(*)'];
        if ($law_count == 1) {
            return 0;
        }
        $conn->query("update elections_law set disagree = disagree + 1 where id = " . $law_id);
        $conn->query("insert into elections_law_user set user_id = " . $user . ", law_id = " . $law_id);
        return 0;
    }

    public static function sussed_laws($law_id) {
        global $conn;
        $law_sql = $conn->query("select * from elections_law where id = " . $law_id)->fetch();
        $time = date("Y-m-d H:i:s");
        $datetime = strtotime($time) + strtotime("0000-00-01 00:00:00") - strtotime("0000-00-00 00:00:00");
        $sql_time = date("Y-m-d H:i:s", $datetime);
        if ($law_sql['agree'] > $law_sql['disagree']) {
            if ($law_sql['type'] == 'change_name') {
                if ($law_sql['time'] < $sql_time) {
                    goverment\info::change_name($law_sql['gover_id'], $law_sql['value']);
                }
            } elseif ($law_sql['type'] == 'change_priv_leader') {
                if ($law_sql['time'] < $sql_time) {
                    goverment\info::change_priv_leader($law_sql['gover_id'], $law_sql);
                }
            }
        }
        laws::clean_elections_law_logs($law_id);
        echo 'test';
    }

    public static function clean_elections_law_logs($law_id){
        global $conn;
        $conn->query("delete from elections_law_user where law_id = " . $law_id);
    }

    public static function delete_elections_law($law_id){
        global $conn;
        $conn->query("delete from elections_law where id = " . $law_id);
    }
}
