<?php

$host = "localhost";
$db = "admin_game";
$username = "admin_admin";
$password = "nBwwgDyG0l";

$dsn = "mysql:host=$host;dbname=$db";

try {
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

