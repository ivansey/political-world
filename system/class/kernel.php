<?php

namespace system;

include '../func.php';

class kernel
{

public static function php_error_log()
{
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
}

}