<?php
error_reporting(E_ALL);

echo "<h2>Соединение TCP/IP</h2>\n";

/* Получаем порт сервиса WWW. */
$service_port = getservbyname('www', 'tcp');

/* Получаем IP-адрес целевого хоста. */
$address = gethostbyname('www.google.com');

/* Создаём сокет TCP/IP. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "Не удалось выполнить socket_create(): причина: " . socket_strerror(socket_last_error()) . "\n";
} else {
    echo "OK.\n";
}

echo "Пытаемся соединиться с '$address' на порту '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "Не удалось выполнить socket_connect().\nПричина: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
    echo "OK.\n";
}

$in = "HEAD / HTTP/1.1\r\n";
$in .= "Host: www.example.com\r\n";
$in .= "Connection: Close\r\n\r\n";
$out = '';

echo "Отправляем HTTP-запрос HEAD...";
socket_write($socket, $in, strlen($in));
echo "OK.\n";

echo "Читаем ответ:\n\n";
while ($out = socket_read($socket, 2048)) {
    echo $out;
}

echo "Закрываем сокет...";
socket_close($socket);
echo "OK.\n\n";
?>


