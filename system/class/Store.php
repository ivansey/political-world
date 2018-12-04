<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 13.11.18
 * Time: 19:16
 */

class Store
{
    public $user_id;
    public $res;
    public $type;
    public $num;
    public $conn;
    public $echo;

    public function __construct($conn, $user_id, $type, $num)
    {
        $this->conn     = $conn;
        $this->user_id  = $user_id;
        $this->type     = $type;
        $this->num      = $num;
    }

    public function add()
    {
        $conn       = $this->conn;
        $user_id    = $this->user_id;
        $type       = $this->type;
        $num        = $this->num;
        $conn->query("UPDATE store SET " . $type . " = " . $type . " + " . $num . " WHERE id = " . $user_id);
    }
}