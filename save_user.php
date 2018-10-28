<?php
include "system/func.php";
noauth();

$email = text($_POST['mail']);
$password = text($_POST['password']);
$password_md5 = md5($password);
$date_reg = date('Y-m-d');
$name = "player" . rand();

if(strlen($email) < 6) {
die( 'Слишком короткий email');
}

$sql = $conn->query("SELECT COUNT(*) FROM users WHERE mail='$email'")->fetch()['COUNT(*)'];
if ($sql == 0) {
    $query = $conn->prepare('INSERT INTO `users` SET `mail` = :email, `password` = :password_md5, `name` = :name, `date_reg` = :date_reg, `gold` = 250, `money` = 1000000');
    $query->bindValue(":email", $email);
    $query->bindValue(":password_md5", $password_md5);
    $query->bindValue(":name", $name);
    $query->bindValue(":date_reg", $date_reg);
    $query->execute();
    $id = $conn->query("SELECT users WHERE id = '" . $email . "'")->fetch();
    $conn->query("INSERT INTO store SET id = '" . $id['id'] . "'");
    echo "Вы успешно зарегистрировались как '$email'";
    echo "<a href=login.php>Вход</a>'";
} else {
    die("Пользователь с таким email существует");
}

