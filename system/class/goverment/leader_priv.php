<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 06.12.18
 * Time: 6:04
 */

namespace goverment;


class leader_priv
{
    public $gover_id;
    public $leader;

    public $priv_change_gov_info;
    public $priv_change_parl;
    public $priv_change_economic_laws;
    public $priv_change_army;
    public $priv_change_spec_laws;
    public $priv_change_contract;

    public function __construct($gover_id)
    {
        $this->gover_id = $gover_id;
        global $conn;
        $priv_sql = $conn->query("select * from gover_leader_priv where id = $gover_id")->fetch();
        $this->leader = $priv_sql['user_id'];
        $this->priv_change_gov_info = $priv_sql['change_info'];
        $this->priv_change_parl = $priv_sql['change_parl'];
        $this->priv_change_economic_laws = $priv_sql['change_economic_laws'];
        $this->priv_change_army = $priv_sql['change_army'];
        $this->priv_change_spec_laws = $priv_sql['change_special_laws'];
        $this->priv_change_contract = $priv_sql['change_contract'];
    }

    public function info()
    {

        return $this;
    }
}