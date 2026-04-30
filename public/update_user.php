<?php
require_once 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

//Валидация
$id = filter_var($_POST['id'] ?? 0, FILTER_VALIDATE_INT);
$name = trim($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$age = filter_var($_POST['age'] ?? 0, FILTER_VALIDATE_INT);

$errors = [];
if (!$id) $errors[] = "ID не указан";
if (empty($name)) $errors[] = "Имя обязательно";
if (!$email)  $errors[] = "Некорректный email";
if ($age === false || $age < 0) $errors = "Некорректный возраст";

if (!empty($errors)) {
    die(implode("<br>", $errors));
}

// Подготовленный запрос
$stmt = mysqli_prepare($conn, "UPDATE users SET name=?, email=?, age=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "ssii", $name, $email, $age, $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2 style='color: green;'>✅ Пользователь обновлён!</h2>";
    echo "<a href='db_test.php'>К списку</a>";
} else {
    echo "Ошибка: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
