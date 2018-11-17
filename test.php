<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 04.11.18
 * Time: 19:02
 */
include('system/func.php');
//require_once('system/class.php');
require_once('system/class/Echo_Name.php');
$class = new Echo_Name($conn, $user['id']);
$echo = $class->echo_name();
echo $echo;