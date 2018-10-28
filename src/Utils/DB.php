<?php
/**
 * Created by PhpStorm.
 * User: Nyx
 * Date: 20.10.2018
 * Time: 16:03
 */

namespace Util;

use PDO;

class DB{
    private static $instance;
    private $db;

    private static function instance(): DB{
        return isset(static::$instance) ? static::$instance : (static::$instance = new static());
    }

    private function __construct(){
        $this->db = new PDO("mysql:host=localhost;dbname=admin_game",
            'admin_admin', 'nBwwgDyG0l');
    }

    /**
     * @param string $query
     * @return array|null
     */
    public static function execute(string $query){
        return self::instance()->db->query($query)->fetchAll();
    }
}