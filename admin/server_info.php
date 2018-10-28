<?php
include('../system/func.php');
auth();
su_auth();
banned($user);
echo $_SERVER['SERVER_SOFTWARE'];
echo("<br>");
echo $phpver = phpversion();
echo("<br>");
?>
