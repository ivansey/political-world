<?php
include_once('func.php');
session_start();

$result = json_decode($_GET['api_result'], true); 
$login = $result['response'][0]['first_name'] . ' ' . $result['response'][0]['last_name'];
$user_id = $result['response'][0]['id'];
create_user($user_id, $login);
?>
