<?php
require_once 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// 1. ВАЛИДАЦИЯ (проверка данных)
$name = trim($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$age = filter_var($_POST['age'] ?? 0, FILTER_VALIDATE_INT);

$errors = [];
if (empty($name)) {
    $errors[] = "Имя обязательно";
}
if (!$email) {
    $errors[] = "Некорректный email";
}
if ($age === false || $age < 0 || $age > 150) {
    $errors[] = "Некорректный возраст";
}

if (!empty($errors)) {
    echo "<h2 style='color: red;'>Ошибки:</h2><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul><a href='add_user.html'>Назад</a>";
    exit;
}

// 2. ПОДГОТОВЛЕННЫЙ ЗАПРОС (защита от SQL-инъекций)
$stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $age);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2 style='color: green;'>✅ Пользователь добавлен!</h2>";
    echo "<a href='db_test.php'>К списку</a>";
} else {
    echo "Ошибка: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
