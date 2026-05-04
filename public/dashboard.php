<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>

<body>
    <h2>Личный кабинет</h2>
    <p>Добро пожаловать, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
    <p>Ваш email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>

    <h3>Ваши действия:</h3>
    <ul>
        <li><a href="db_test.php">Управление пользователями</a></li>
        <li><a href="logout.php">Выйти</a></li>
    </ul>
</body>

</html>