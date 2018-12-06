<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 29.11.18
 * Time: 6:55
 */

namespace goverment;

include '../func.php';

class info
{
    public $gover_id;
    public $name;
    public $leader;
    public $pri_reg;
    public $type;

    public $change_info;
    public $change_parl;
    public $change_economic_laws;
    public $change_army;
    public $change_special_laws;
    public $change_contract;
    public $change_leaders;

    public function __construct($gover_id)
    {
        global $conn;
        $gover = $conn->query("select * from goverment where id = " . $gover_id)->fetch();
        $this->gover_id = $gover_id;
        $this->name = $gover['name'];
        $this->leader = $gover['king_id'];
        $this->pri_reg = $gover['pri_reg'];
        $this->type = $gover['type'];
        $leader = $conn->query("select * from gover_leader_priv where id = " . $gover_id)->fetch();
        $this->change_info = $leader['change_info'];
        $this->change_parl = $leader['change_parl'];
        $this->change_economic_laws = $leader['change_economic_laws'];
        $this->change_army = $leader['change_army'];
        $this->change_special_laws = $leader['change_special_laws'];
        $this->change_contract = $leader['change_contract'];
        $this->change_leaders = $leader['change_leaders'];
    }

    public function info()
    {
        $info = array(
            'name' => $this->name,
            'leader' => $this->leader,
            'pri_reg' => $this->pri_reg,
            'type' => $this->type
        );
        return $info;
    }

    public function priv_leader()
    {
        $priv_leader = array(
            'change_info' => $this->change_info,
            'change_parl' => $this->change_parl,
            'change_economic_laws' => $this->change_economic_laws,
            'change_army' => $this->change_army,
            'change_special_laws' => $this->change_special_laws,
            'change_contract' => $this->change_contract,
            'change_leaders' => $this->change_leaders
        );
        return $priv_leader;
    }

    public static function notifi($text, $gover_id)
    {
        global $conn;
        $sql = $conn->query("select * from users where gover = " . $gover_id);
        while ($sqli = $sql->fetch()) {
            notification($text, date('Y-m-d H:i:s'), '/goverment/view.php?id=' . $gover_id, $sqli['id']);
        }
    }

    public static function add_goverment($name, $user_id)
    {
        global $conn;
        $conn->query("insert into goverment set name = " . $name . ", king_id = " . $user_id);
        $id = $conn->query("select * from goverment where king_id = " . $user_id)->fetch();
        $conn->query("insert into gover_leader_priv set id = " . $id . ", user_id = " . $user_id);
    }

    public static function change_name($gover_id, $value)
    {
        global $conn;
        $conn->query("update goverment set name = '" . $value . "' where id = " . $gover_id);
        //self::notifi('Изменено название  государства', $gover_id);
    }

    public static function change_priv_leader($gover_info, array $priv_lead)
    {
        global $conn;
        $conn->query("update gover_leader_priv set change_info = " . $priv_lead['priv_lead_gov_info'] . ", change_parl = " . $priv_lead['priv_lead_parl'] . ", change_economic_laws = " . $priv_lead['priv_lead_eco_laws'] . ", change_army = " . $priv_lead['priv_lead_army'] . ", change_special_laws = " . $priv_lead['priv_lead_spec_laws'] . ", change_contract = " . $priv_lead['priv_lead_contract'] . " where id = " . $gover_info);
        //self::notifi('Изменение привелегий лидера государства на:<br>
//    Изменение информации' . $_POST['change_info'] . '<br>
//        Парламент' . $_POST['change_parl'] . '<br>
//        Экономика' . $_POST['change_economic_laws'] . '<br>
//        Армия' . $_POST['change_army'] . '<br>
//        Спец. законы' . $_POST['change_special_laws'] . '<br>
//        Соглашения' . $_POST['change_contract'], $gover_info);
    }
}