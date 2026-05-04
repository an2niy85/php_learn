<?php
session_start();
require_once 'config.php';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$login = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($login) || empty($password)) {
    die("Заполните все поля");
}

// Ищем пользователя по логину или email
$stmt = mysqli_prepare($conn, "SELECT id, username, email, password_hash FROM accounts WHERE username = ? OR email = ?");
mysqli_stmt_bind_param($stmt, "ss", $login, $login);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password_hash'])) {
    // Вход успешен — создаём сессию
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];

    echo "<h2 style='color: green;'>✅ Добро пожаловать, " . htmlspecialchars($user['username']) . "!</h2>";
    echo "<a href='dashboard.php'>Перейти в личный кабинет</a>";
} else {
    echo "<h2 style='color: red;'>❌ Неверный логин или пароль</h2>";
    echo "<a href='login.html'>Попробовать снова</a>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
