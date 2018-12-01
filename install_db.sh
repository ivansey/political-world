#!/usr/bin/env bash
#Скрипт установки скрипта коннекта к бд
echo 'Укажите путь к настроенному скрипту коннекта бд (db_connect.php)'
read $path
cp -f $path/db_connect.php system/db_connect.php
chmod ugo+rwx system/db_connect.php
echo 'Готово'
