<?php
include('system/func.php');
noauth();
?>
<html>
<head>
    <title>Вход</title>
</head>
<body>
<form action="login_user.php" method="post"> <div class="block">
    <p>
        <label>Ваш email:<br></label>
        <input name="mail" type="text" size="15">
    </p>
    <p>
        <label>Ваш пароль:<br></label>
        <input name="password" type="password" size="15">
    </p>
    <p>
        <div class="block"><input type="submit" name="submit" value="Войти"></div>
    </p>
</div></form>
</body>
</html>

