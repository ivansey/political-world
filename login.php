<?php
include('system/func.php');
noauth();
?>
<html>
<head>
    <title>Вход</title>
</head>
<body>
<form action="login_user.php" method="post">
    <p>
        <label>Ваш email:<br></label>
        <input name="mail" type="text" size="15">
    </p>
    <p>
        <label>Ваш пароль:<br></label>
        <input name="password" type="password" size="15">
    </p>
    <p>
        <input type="submit" name="submit" value="Войти">
    </p></form>
</div>
</body>
</html>

