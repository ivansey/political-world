<?php
include('func.php');

$conn->query("UPDATE `users` SET `energy` = `energy` + 1");
?>
