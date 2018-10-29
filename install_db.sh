#Скрипт установки скрипта коннекта к бд
echo 'Укажите путь к настроенному скрипту коннекта бд (db_connect.php)'
read $path
cp -f $path system/db_connect.php
echo 'Готово'
