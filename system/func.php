<?php
require_once('db_connect.php');

function text($m){
$m = htmlspecialchars(stripslashes(trim($m)));
	return $m;
} 
function name($userr){
$ur = "$userr[tag]$userr[name]";
return $ur;
}
function auth() {
if(empty($_COOKIE["email"])) {
header("Location: index.php"); exit; 
}
}

function noauth() {
if(!empty($_COOKIE["email"])) {
header("Location: game.php"); exit; 
}
}

if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
	$email=$_COOKIE['email'];
  $password=$_COOKIE['password'];
 $user=$conn->query("SELECT * FROM `users` WHERE `mail` = '".$email."' AND `password` = '".$password."' LIMIT 1")->fetch(); 
if($user[energy] > 200) {
$conn->query("UPDATE `users` SET `energy` = 200 ");
}
  require_once('header_auth.php');
} else {
require_once('header.php');
}
//Инфа о складе 
//$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . "")->fetch();
//Админ/Модер проверка
function moder_auth(array $user) {
    if($user['priv'] < 1) {
	header("Location: /"); exit;
    }
}
function admin_auth(array $user) {
    if($user['priv'] < 2) {
	header("Location: /"); exit;
    }
}
function su_auth(array $user) {
    if($user['priv'] < 3) {
	header("Location: /"); exit;
    }
}

function _string($string) {     
    return (String)$string;   
}
function _num($i) {   
    return (int)$i;
}
//Денежные функции
/*function payment_g(array $user, $gold) {
    if($gold > $user['gold']){ 
	echo('У вас недостаточно средств. У вас ' . $user['gold'] . ', а надо ' . $gold . '.<br>');
    }
    $query = $conn->prepare('UPDATE `users` SET `gold` = `gold` - :gold WHERE `id` = :id');
    $query->bindValue(":gold", $gold);
    $query->bindValue(":id", $user['id']);
    $query->execute();
*/
//Проверка бана
function banned(array $user) {
    $time = date('Y-m-d H:i:s.u');
    if ($user['ban_date'] > $time) {
        header("Location: /errors/ban.php"); 
	exit;
    }
}
function banned_chat(array $user) {
    $time = date('Y-m-d H:i:s.u');
    if ($user['ban_chat_date'] > $time) {
        header("Location: /errors/ban_chat.php"); 
	exit;
    }
}
?>
