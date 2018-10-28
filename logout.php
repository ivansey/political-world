<?php
setcookie('email', null, time() - 86400 * 365, '/');
setcookie('password', null, time() - 86400 * 365, '/');
header('location: /');
exit; 
