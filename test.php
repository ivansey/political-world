<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 04.11.18
 * Time: 19:02
 */
include('system/func.php');
//require_once('system/class.php');
require_once('system/class/store/Store_add.php');
$class = new Store_add();
$class->echo = "Кодеры ебали медведя";
$echo = $class->echo;
echo $echo;