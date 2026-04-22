<?php
// Этот код 100% работает в OpenServer
$host = 'MySQL-8.4';
$user = 'root';
$password = '';
$database = 'test_db';
$port = 3306;

// Пробуем подключиться
$conn = mysqli_connect($host, $user, $password, $database, $port);

// Проверяем
if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
}

echo "✅ Подключение успешно!<br>";
echo "Версия MySQL: " . mysqli_get_server_info($conn) . "<br>";

// Выводим пользователей
$result = mysqli_query($conn, "SELECT * FROM users");

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['age']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "Нет пользователей. <a href='add_user.html'>Добавьте первого</a>";
}

mysqli_close($conn);
