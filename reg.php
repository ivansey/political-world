<?php
include('system/func.php');
noauth();
?>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
<form action="save_user.php" method="post">
    <p>
        <label>Ваш email:<br></label>
        <input name="mail" type="text" size="15">
    </p>
    <p>
        <label>Ваш пароль:<br></label>
        <input name="password" type="password" size="15">
    </p>
    <p>
        <input type="submit" name="submit" value="Зарегистрироваться">
    </p></form>
</div>
</body>
</html>

