<?php
$host = 'MySQL-8.4';
$user = 'root';
$password = '';      // Для OpenServer
$database = 'test_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? 0;

if ($name && $email) {
    $sql = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', $age)";

    if ($conn->query($sql) === TRUE) {
        echo "<h2 style='color: green;'>✅ Пользователь '$name' успешно добавлен!</h2>";
        echo "<p><a href='db_test.php'>Посмотреть список пользователей</a></p>";
        echo "<p><a href='add_user.html'>Добавить ещё</a></p>";
    } else {
        echo "Ошибка: " . $conn->error;
    }
} else {
    echo "Заполните имя и email";
}

$conn->close();
