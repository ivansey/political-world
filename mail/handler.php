<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 25.11.18
 * Time: 13:47
 */
include '../system/func.php';
auth();
banned($user);

$id = $_POST['id'];

header("Location: mail.php?id=" . $id);