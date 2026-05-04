<?php
session_start();
require_once 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Получаем данные
$username = trim($_POST['username'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

$errors = [];

// Валидация
if (empty($username) || strlen($username) < 3) {
    $errors[] = "Логин должен быть не менее 3 символов";
}
if (!$email) {
    $errors[] = "Некорректный email";
}
if (strlen($password) < 6) {
    $errors[] = "Пароль должен быть не менее 6 символов";
}
if ($password !== $confirm) {
    $errors[] = "Пароли не совпадают";
}

// Проверка, не занят ли логин/email
if (!empty($errors)) {
    echo "<div class='error'><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div><a href='register.html'>Назад</a>";
    exit;
}

// Хэшируем пароль и сохраняем
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "INSERT INTO accounts (username, email, password_hash) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_hash);

if (mysqli_stmt_execute($stmt)) {
    echo "<div class='success'>✅ Регистрация успешна! Можете войти.</div>";
    echo "<a href='login.html'>Войти</a>";
} else {
    echo "Ошибка: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
