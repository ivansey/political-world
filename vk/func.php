<?php
include('../system/func.php');

function get_login($id, $token) {
    $url = 'https://api.vk.com/method/users.get?user_id=' . $id . '&v=5.52&access_token=' . $token . '';
    $result = file_get_contents($url);

    $result = json_decode($result, true);

    $login = $result['response'][0]['first_name'] . ' ' . $result['response'][0]['last_name'];

    return $login;
}

function create_user($id, $name) {
    try {
        global $conn;

        $sql = $conn->query("SELECT COUNT(*) FROM vk_users WHERE vk_id=$id")->fetch()['COUNT(*)'];
        if ($sql == 0) {
            // Раз
            //session_start();
            $date_reg = date('Y-m-d');
            $pass = bin2hex(openssl_random_pseudo_bytes(16));
            $query = $conn->prepare('INSERT INTO `users` SET `mail` = :email, `password` = :password_md5, `name` = :name, `date_reg` = :date_reg, `gold` = 250, `money` = 1000000');
            $query->bindValue(":email", $id);
            $query->bindValue(":password_md5", $pass);
            $query->bindValue(":name", $name);
            $query->bindValue(":date_reg", $date_reg);
            $query->execute();
            // Второй этап
            $usero = $conn->query("   SELECT * FROM users WHERE mail = '$id' LIMIT 1")->fetch();
            // Второй этап->Создание склада
            $ress = $conn->query("SELECT COUNT(*) FROM resourse")->fetch()['COUNT(*)'];
            $i = 0;
            while ($i < $ress) {
                $res = $conn->query("SELECT * FROM resourse LIMIT " . $i . ",1")->fetch();
                $conn->query("INSERT INTO store SET id = " . $usero['id'] . ", type = " . $res['id']);
                $i++;
            }
            $query = $conn->query("INSERT INTO vk_users SET vk_id = $id, user_id = $usero[id]");
            // Три
            setcookie("email", $id, time()+60*60*24, "/");
            setcookie("password", $pass, time()+60*60*24, "/");
            header('Location: /');
        } else {
            //session_start();
            $userot = $conn->query("SELECT * FROM users WHERE mail = '$id' LIMIT 1")->fetch();
            $pass = $userot['password'];
            setcookie("email", $id, time()+60*60*24, "/");
            setcookie("password", $pass, time()+60*60*24, "/");
            header('Location: /');
        }
    } catch (PDOException $pdo_error) {
        echo $pdo_error->getMessage();
    }
}
function get_tok() {
$url = 'https://oauth.vk.com/access_token?client_id=6747984&client_secret=k1JoIQb4NYH648fBNwjz&v=5.87&grant_type=client_credentials';

$result = file_get_contents($url);
$result = json_decode($result, true);

$access_token = $result['access_token'];
return $access_token;
}
?>
