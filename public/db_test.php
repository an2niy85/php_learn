<?php
// Параметры подключения для OpenServer
require_once __DIR__ . '/config.php';

// Создаём подключение
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);

// Проверяем подключение
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

echo "<h2>Подключение успешно!</h2>";

// Запрос без пользовательских данных (можно без prepare)
$result = mysqli_query($conn, "SELECT id, name, email, age FROM users");

echo "<h2>Список пользователей</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Имя</th><th>Email</th><th>Возраст</th><th>Действия</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . (int)$row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . (int)$row['age'] . "</td>";
        echo "<td>
            <a href='/edit_user.php?id=" . (int)$row['id'] . "'>✏️ Редактировать</a> |
            <a href='delete_user.php?id=" . (int)$row['id'] . "' onclick='return confirm(\"Удалить?\")'>🗑️ Удалить</a>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет записей";
}

echo "<p><a href='add_user.html'>➕ Добавить пользователя</a></p>";
echo "<hr>";
echo "<p><a href='dashboard.php'>← Назад в личный кабинет</a></p>";
echo "<p><a href='logout.php'>🚪 Выйти</a></p>";

mysqli_close($conn);
