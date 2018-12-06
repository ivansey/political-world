<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 06.12.18
 * Time: 10:03
 */

namespace kernel;


class php
{
    public static function php_error_log()
    {
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }

}