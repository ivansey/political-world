<?php
require_once('db_connect.php');
include 'class/bbcode.php';
//require_once('class.php');
//include('economic.php');

function text($m)
{
    $m = htmlspecialchars(stripslashes(trim($m)));
    return $m;
}

function name($userr)
{
    if ($userr['tag'] == "") {
        $ur = "<a href='../users/index.php?user_id=" . $userr['id'] . "'>" . $userr['name'] . "</a>";
    }else{
        $ur = "<a href='../users/index.php?user_id=" . $userr['id'] . "'>" . "[" . $userr['tag'] . "] " .  $userr['name'] . "</a>";
    }
    return $ur;
}

function notification($text, $time, $href, array $userrr) {
global $conn;
$conn->query("INSERT INTO notifications SET text = '$text', time = '$time', href = '$href', user = $userrr[id]");
}

function auth()
{
    if (empty($_COOKIE["email"])) {
        header("Location: index.php");
        exit;
    }
}

function noauth()
{
    if (!empty($_COOKIE["email"])) {
        header("Location: game.php");
        exit;
    }
}

if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    $user = $conn->query("SELECT * FROM `users` WHERE `mail` = '" . $email . "' AND `password` = '" . $password . "' LIMIT 1")->fetch();
    $region_user = $conn->query("SELECT * FROM `regions` WHERE `id` = " . $user['region'] . " ")->fetch();
    if ($user[energy] > 200) {
        $conn->query("UPDATE `users` SET `energy` = 200 WHERE `id` = " . $user['id'] . " ");
    }
    require_once('header_auth.php');
} else {
    require_once('header.php');
}

//Инфа о складе 
//$store = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . "")->fetch();
//ИД юзера
$id_user = $user['id'];
//Админ/Модер проверка
function moder_auth(array $user)
{
    if ($user['priv'] < 1) {
        header("Location: /");
        exit;
    }
}

function admin_auth(array $user)
{
    if ($user['priv'] < 2) {
        header("Location: /");
        exit;
    }
}

function su_auth(array $user)
{
    if ($user['priv'] < 3) {
        header("Location: /");
        exit;
    }
}

function _string($string)
{
    return (String)$string;
}

function _num($i)
{
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
function banned(array $user)
{
    $time = date('Y-m-d H:i:s.u');
    if ($user['ban_date'] > $time) {
        header("Location: /errors/ban.php");
        exit;
    }
}

function banned_chat(array $user)
{
    $time = date('Y-m-d H:i:s.u');
    if ($user['ban_chat_date'] > $time) {
        header("Location: /errors/ban_chat.php");
        exit;
    }
}

//Складовые функции
function store_add_metal($id_user, $res)
{
    global $conn;
    $store_id = $conn->query("SELECT * FROM store WHERE id = $id_user")->fetch();
    if ($res < 0)
        die('Данные меньше нуля<br><a href="javascript:history.back()" title="Вернуться на предыдущую страницу" >Назад</a><br>');

    $query = $conn->prepare("UPDATE `store` SET `metal` = `metal` + :res  WHERE `id` = :user");
    $query->bindValue(":res", $res);
    $query->bindValue(":user", $id_user);
    $query->execute();
}

function store_del_metal($id_user, $res)
{
    global $conn;
    $store_id = $conn->query("SELECT * FROM `store` WHERE `id` = " . $user['id'] . " ");
    if ($res > $store_id['metal']) {
        die('Данные больше остатка на складе<br><a href="javascript:history.back()" title="Вернуться на предыдущую страницу" >Назад</a><br>');
    }
    $query = $conn->prepare('UPDATE `store` SET `metal` = `metal` - :res  WHERE `id` = :user');
    $query->bindValue(":res", $res);
    $query->bindValue(":id", $user['id']);
    $query->execute();
}

function text_smile($text) {
    $text = str_ireplace(":)))", "<img src='/design/images/smile/:super_smile.png'>", $text);
    $text = str_ireplace(":)", "<img src='/design/images/smile/:smile.png'>", $text);
    $text = str_ireplace(":(((", "<img src='/design/images/smile/:(((.png'>", $text);
    $text = str_ireplace(":#", "<img src='/design/images/smile/:ups.png'>", $text);
    $text = str_ireplace(":()", "<img src='/design/images/smile/:().png'>", $text);
    $text = str_ireplace(":*", "<img src='/design/images/smile/:*.png'>", $text);
    $text = str_ireplace(":00", "<img src='/design/images/smile/:00.png'>", $text);
    $text = str_ireplace(":;", "<img src='/design/images/smile/:;.png'>", $text);
    $text = str_ireplace(":>>>", "<img src='/design/images/smile/:>>>.png'>", $text);
    $text = str_ireplace(":>", "<img src='/design/images/smile/:>.png'>", $text);
    $text = str_ireplace(":???", "<img src='/design/images/smile/:???.png'>", $text);
    $text = str_ireplace(":aaa", "<img src='/design/images/smile/:aaa.png'>", $text);
    $text = str_ireplace(":baz", "<img src='/design/images/smile/:baz.png'>", $text);
    $text = str_ireplace(":boom", "<img src='/design/images/smile/:boom.png'>", $text);
    $text = str_ireplace(":botton", "<img src='/design/images/smile/:botton.png'>", $text);
    $text = str_ireplace(":brrr", "<img src='/design/images/smile/:brrr.png'>", $text);
    $text = str_ireplace(":hello", "<img src='/design/images/smile/:hello.png'>", $text);
    $text = str_ireplace(":love", "<img src='/design/images/smile/:love.png'>", $text);
    $text = str_ireplace(":n", "<img src='/design/images/smile/:n.png'>", $text);
    $text = str_ireplace(":noc", "<img src='/design/images/smile/:noc.png'>", $text);
    $text = str_ireplace(":phone", "<img src='/design/images/smile/:phone.png'>", $text);
    $text = str_ireplace(":tsss", "<img src='/design/images/smile/:tsss.png'>", $text);
    $text = str_ireplace(":z-z-z", "<img src='/design/images/smile/:z-z-z.png'>", $text);
    $text = str_ireplace(":zzzzzz", "<img src='/design/images/smile/:zzzzzz.png'>", $text);
    $text = str_ireplace(":zzz", "<img src='/design/images/smile/:zzz.png'>", $text);
    $text = str_ireplace(":|", "<img src='/design/images/smile/:|.png'>", $text);
    $text = str_ireplace(":~", "<img src='/design/images/smile/:~.png'>", $text);
    $text = str_ireplace(":gif/boo-fnaf", "<img src='/design/images/smile/boo-fnaf.gif'>", $text);
    return $text;
}
function look_smile() {
    echo ':) <img src=\'/design/images/smile/:smile.png\'><br>
    :))) <img src=\'/design/images/smile/:super_smile.png\'><br>
    :((( <img src=\'/design/images/smile/:(((.png\'><br>
    :# <img src=\'/design/images/smile/:ups.png\'><br>
    :() <img src=\'/design/images/smile/:().png\'><br>
    :* <img src=\'/design/images/smile/:*.png\'><br>
    :00 <img src=\'/design/images/smile/:00.png\'><br>
    :; <img src=\'/design/images/smile/:;.png\'><br>
    :> <img src=\'/design/images/smile/:>.png\'><br>
    :>>> <img src=\'/design/images/smile/:>>>.png\'><br>
    :??? <img src=\'/design/images/smile/:???.png\'><br>
    :aaa <img src=\'/design/images/smile/:aaa.png\'><br>
    :baz <img src=\'/design/images/smile/:baz.png\'><br>
    :boom <img src=\'/design/images/smile/:boom.png\'><br>
    :botton <img src=\'/design/images/smile/:botton.png\'><br>
    :brrr <img src=\'/design/images/smile/:brrr.png\'><br>
    :hello <img src=\'/design/images/smile/:hello.png\'><br>
    :love <img src=\'/design/images/smile/:love.png\'><br>
    :n <img src=\'/design/images/smile/:n.png\'><br>
    :noc <img src=\'/design/images/smile/:noc.png\'><br>
    :phone <img src=\'/design/images/smile/:phone.png\'><br>
    :tsss <img src=\'/design/images/smile/:tsss.png\'><br>
    :z-z-z <img src=\'/design/images/smile/:z-z-z.png\'><br>
    :zzz <img src=\'/design/images/smile/:zzz.png\'><br>
    :zzzzzz <img src=\'/design/images/smile/:zzzzzz.png\'><br>
    :| <img src=\'/design/images/smile/:|.png\'><br>
    :~ <img src=\'/design/images/smile/:~.png\'><br>
    :gif/boo-fnaf <img src=\'/design/images/smile/boo-fnaf.gif\'><br>
    ';
}
function closed(array $user) {
if($user['priv'] != 3) {
die('<div class="block">Проводятся тех.работы'.$user[priv].'</div><br><div class="a"><a href=/>На главную</a></div>');
}
}
?>
