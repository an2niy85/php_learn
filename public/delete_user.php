<?php
require_once 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Валидация ID
$id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);

if (!$id) {
    die("Неверный ID");
}

// Подготовленный запрос
$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2 style='color: green;'>✅ Пользователь удалён!</h2>";
    echo "<a href='db_test.php'>К списку</a>";
} else {
    echo "Ошибка: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
