<?php
include('../system/func.php');
//include '../system/class/bbcode.php';
auth();
banned($user);
admin_auth($user);

if(isset($_POST['post'])) {
$id = $_POST['id'];
header("Location: edit_user.php?id=$id");
}
?>
<div class="block"><form method='post' action=''>
Ид жертвы:<br><input type='text' name='id' value=''><br>
<input type='submit' name='post' value='Зарезать'>
</form>
</div>
<div class='a'><a href=index.php>Назад</a></div>