<?php
$host = 'MySQL-8.4';
$user = 'root';
$password = '';      // Для OpenServer
$database = 'test_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$id = $_POST['id'] ?? 0;
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? 0;

if ($name && $email) {
    $sql = "UPDATE users SET name='$name', email='$email', age=$age WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<h2 style='color: green;'>✅ Пользователь обновлён!</h2>";
        echo "<a href='db_test.php'>Вернуться к списку</a>";
    } else {
        echo "Ошибка: " . $conn->error;
    }
} else {
    echo "Заполните имя и email";
}

$conn->close();
