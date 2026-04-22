<?php
$host = 'MySQL-8.4';
$user = 'root';
$password = '';      // Для OpenServer
$database = 'test_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

$sql = "DELETE FROM users WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<h2 style='color: green;'>✅ Пользователь удалён!</h2>";
    echo "<a href='db_test.php'>Вернуться к списку</a>";
} else {
    echo "Ошибка: " . $conn->error;
}

$conn->close();
