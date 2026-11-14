<?php
// Включаем вывод ошибок для отладки
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$password = ''; // В XAMPP пароль пустой
$dbname = 'matpomosh_db';

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?><?php
$host = 'localhost';
$user = 'root';
$password = ''; // В XAMPP по умолчанию пароль пустой
$dbname = 'matpomosh_db';

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>
