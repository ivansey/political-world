<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 13.11.18
 * Time: 18:38
 */
include '../func.php';

class Echo_Name
{
    public      $user_id;
    public      $user_name;
    public      $conn;
    protected   $name;
    public      $url;

    public function __construct($conn, $user_id)
    {
        $this->conn     = $conn;
        $this->user_id  = $user_id;
    }

    public function echo_name()
    {
        $conn               = $this->conn;
        $user_id            = $this->user_id;
        $this->name         = $conn->query("SELECT * FROM users WHERE id = " . $user_id)->fetch();
        $name               = $this->name;
        $url                = '<a href="/users/index.php?id="' . $name['id'] . '">' . $name['name'] . '</a>';
        $this->url          = $url;
        return $this->url;
    }
}